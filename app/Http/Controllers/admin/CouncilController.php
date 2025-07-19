<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Council;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CouncilController extends Controller
{

    public function index()
    {
        $councils = Council::all();

        return view('admin.councils.index', get_defined_vars());
    }

    public function create()
    {
        return view('admin.councils.create', [
            'targetLanguages' => $this->targetLanguages
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();
            $councilData = [
                'name_ar' => $request->name_ar,
                'status' => $request->status
            ];

            $tr = new GoogleTranslate('ar');

            foreach ($this->targetLanguages as $code => $name) {
                $titleColumn = 'name_' . $code;
                try {
                    if (in_array($titleColumn, (new Council())->getFillable())) {
                        $councilData[$titleColumn] = $tr->setTarget($code)->translate($request->name_ar);
                    } else {
                        Log::warning("Columns {$titleColumn} not found in Council model fillable. Skipping translation.");
                    }
                } catch (\Exception $e) {
                    $councilData[$titleColumn] = null;
                    Log::error("Translation failed for {$code} (Council Store): " . $e->getMessage());
                }
            }


            Council::create($councilData);

            DB::commit();
            return redirect()->route('admin.council.index')->with('success', 'تمت إضافة محتوى صفحة "معلومات عنا" بنجاح!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Council $council)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.councils.show', compact('council', 'targetLanguages'));
    }

    public function edit($council)
    {
        $council = Council::findOrFail($council);
        $targetLanguages = $this->targetLanguages;

        return view('admin.councils.edit', compact('council', 'targetLanguages'));
    }

    public function update(Request $request, Council $council)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();
            $councilData = [
                'name_ar' => $request->name_ar,
                'status' => $request->status
            ];

            $tr = new GoogleTranslate('ar');

            foreach ($this->targetLanguages as $code => $name) {
                $titleColumn = 'name_' . $code;
                try {
                    if (in_array($titleColumn, (new Council())->getFillable())) {
                        $councilData[$titleColumn] = $tr->setTarget($code)->translate($request->name_ar);
                    } else {
                        Log::warning("Columns {$titleColumn} not found in Council model fillable. Skipping translation.");
                    }
                } catch (\Exception $e) {
                    $councilData[$titleColumn] = null;
                    Log::error("Translation failed for {$code} (Council Update): " . $e->getMessage());
                }
            }

            if ($request->hasFile('image')) {
                if ($council->image) {
                    Storage::disk('public')->delete($council->image);
                }
                $councilData['image'] = $request->file('image')->store('councils/main', 'public');
            } elseif ($request->boolean('remove_image')) {
                if ($council->image) {
                    Storage::disk('public')->delete($council->image);
                    $councilData['image'] = null;
                }
            }

            DB::commit();
            return redirect()->route('admin.council.index')->with('success', 'تم تحديث محتوى صفحة "معلومات عنا" بنجاح!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Council $council)
    {
        if ($council->image) {
            Storage::disk('public')->delete($council->image);
        }

        $council->delete();

        return redirect()->route('admin.council.index')->with('success', 'تم حذف محتوى صفحة "معلومات عنا" بنجاح!');
    }
}
