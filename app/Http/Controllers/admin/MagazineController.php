<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::latest()->paginate(10);
        return view('admin.magazines.index', compact('magazines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_image' => 'nullable|array',
            'sub_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $magazinesData = [
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $descColumn = 'description_' . $code;
            try {
                if (in_array($titleColumn, (new Magazine())->getFillable())) {
                    $magazinesData[$titleColumn] = $tr->setTarget($code)->translate($request->input('title_ar'));
                    $magazinesData[$descColumn] = $tr->setTarget($code)->translate($request->input('description_ar'));
                } else {
                    Log::warning("Columns {$titleColumn} or {$descColumn} not found in Magazine model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $magazinesData[$titleColumn] = null;
                $magazinesData[$descColumn] = null;
                Log::error("Translation failed for {$code} (Magazine Store): " . $e->getMessage());
            }
        }

        if ($request->hasFile('main_image')) {
            $magazinesData['main_image'] = $request->file('main_image')->store('magazines/main', 'public');
        }

        if ($request->sub_image) {
            $magazinesData['sub_image'] = [];
            foreach ($request->sub_image as $image) {
                $magazinesData['sub_image'][] = $image->store('magazines/sub', 'public');
            }
        }

        Magazine::create($magazinesData);

        return redirect()->route('admin.magazines.index')->with('success', 'تمت إضافة الخبر بنجاح!');
    }

    public function show(Magazine $magazine)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.magazines.show', compact('magazine', 'targetLanguages'));
    }

    public function edit(Magazine $magazine)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.magazines.edit', compact('magazine', 'targetLanguages'));
    }

    public function update(Request $request, Magazine $magazine)
    {
        $request->validate([
            'title_ar' => [
                'required',
                'string',
                'max:255',
            ],
            'description_ar' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_image' => 'nullable|array',
            'sub_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $magazinesData = [
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $descColumn = 'description_' . $code;
            try {
                if (in_array($titleColumn, (new Magazine())->getFillable())) {
                    $magazinesData[$titleColumn] = $tr->setTarget($code)->translate($request->input('title_ar'));
                    $magazinesData[$descColumn] = $tr->setTarget($code)->translate($request->input('description_ar'));
                } else {
                    Log::warning("Columns {$titleColumn} or {$descColumn} not found in Magazine model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $magazinesData[$titleColumn] = null;
                $magazinesData[$descColumn] = null;
                Log::error("Translation failed for {$code} (Magazine Update): " . $e->getMessage());
            }
        }

        if ($request->hasFile('main_image')) {
            if ($magazine->main_image) {
                Storage::disk('public')->delete($magazine->main_image);
            }
            $magazinesData['main_image'] = $request->file('main_image')->store('magazines/main', 'public');
        } elseif ($request->boolean('remove_main_image')) {
            if ($magazine->main_image) {
                Storage::disk('public')->delete($magazine->main_image);
                $magazinesData['main_image'] = null;
            }
        }


        if ($request->sub_image) {
            foreach ($magazine->sub_image as $image) {
                Storage::disk('public')->delete($image);
            }

            $magazinesData['sub_image'] = [];
            foreach ($request->sub_image as $image) {
                $magazinesData['sub_image'][] = $image->store('magazines/sub', 'public');
            }
        } elseif ($request->boolean('remove_sub_image')) {
            if ($magazine->sub_image) {
                foreach ($magazine->sub_image as $image) {
                    Storage::disk('public')->delete($image);
                }
                $magazinesData['sub_image'] = null;
            }
        }

        $magazine->update($magazinesData);

        return redirect()->route('admin.magazines.index')->with('success', 'تم تحديث الخبر بنجاح!');
    }

    public function destroy(Magazine $magazine)
    {
        if ($magazine->main_image) {
            Storage::disk('public')->delete($magazine->main_image);
        }

        foreach ($magazine->sub_image as $image) {
            Storage::disk('public')->delete($image);
        }

        $magazine->delete();

        return redirect()->route('admin.magazines.index')->with('success', 'تم حذف الخبر بنجاح!');
    }
}
