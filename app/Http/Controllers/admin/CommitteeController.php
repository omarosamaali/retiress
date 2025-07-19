<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CommitteeController extends Controller
{

    public function index()
    {
        $committees = Committee::all();

        return view('admin.committees.index', get_defined_vars());
    }

    public function create()
    {
        return view('admin.committees.create', [
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
            $committeeData = [
                'name_ar' => $request->name_ar,
                'status' => $request->status
            ];

            $tr = new GoogleTranslate('ar');

            foreach ($this->targetLanguages as $code => $name) {
                $titleColumn = 'name_' . $code;
                try {
                    if (in_array($titleColumn, (new Committee())->getFillable())) {
                        $committeeData[$titleColumn] = $tr->setTarget($code)->translate($request->name_ar);
                    } else {
                        Log::warning("Columns {$titleColumn} not found in Committee model fillable. Skipping translation.");
                    }
                } catch (\Exception $e) {
                    $committeeData[$titleColumn] = null;
                    Log::error("Translation failed for {$code} (Committee Store): " . $e->getMessage());
                }
            }


            Committee::create($committeeData);

            DB::commit();
            return redirect()->route('admin.committee.index')->with('success', 'تمت إضافة محتوى صفحة "معلومات عنا" بنجاح!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Committee $committee)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.committees.show', compact('committee', 'targetLanguages'));
    }

    public function edit($committee)
    {
        $committee = Committee::findOrFail($committee);
        $targetLanguages = $this->targetLanguages;

        return view('admin.committees.edit', compact('committee', 'targetLanguages'));
    }

    public function update(Request $request, Committee $committee)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();
            $committeeData = [
                'name_ar' => $request->name_ar,
                'status' => $request->status
            ];

            $tr = new GoogleTranslate('ar');

            foreach ($this->targetLanguages as $code => $name) {
                $titleColumn = 'name_' . $code;
                try {
                    if (in_array($titleColumn, (new Committee())->getFillable())) {
                        $committeeData[$titleColumn] = $tr->setTarget($code)->translate($request->name_ar);
                    } else {
                        Log::warning("Columns {$titleColumn} not found in Committee model fillable. Skipping translation.");
                    }
                } catch (\Exception $e) {
                    $committeeData[$titleColumn] = null;
                    Log::error("Translation failed for {$code} (Committee Update): " . $e->getMessage());
                }
            }

            if ($request->hasFile('image')) {
                if ($committee->image) {
                    Storage::disk('public')->delete($committee->image);
                }
                $committeeData['image'] = $request->file('image')->store('committees/main', 'public');
            } elseif ($request->boolean('remove_image')) {
                if ($committee->image) {
                    Storage::disk('public')->delete($committee->image);
                    $committeeData['image'] = null;
                }
            }

            DB::commit();
            return redirect()->route('admin.committee.index')->with('success', 'تم تحديث محتوى صفحة "معلومات عنا" بنجاح!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Committee $committee)
    {
        if ($committee->image) {
            Storage::disk('public')->delete($committee->image);
        }

        $committee->delete();

        return redirect()->route('admin.committee.index')->with('success', 'تم حذف محتوى صفحة "معلومات عنا" بنجاح!');
    }
}
