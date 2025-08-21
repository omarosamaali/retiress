<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\MemberApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MagazineController extends Controller
{
    public function index()
    {
        $member_applications = MemberApplication::all();
        $magazines = Magazine::latest()->paginate(10);
        return view('admin.magazines.index', compact('magazines', 'member_applications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
            'sub_images' => 'nullable|array|max:10',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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

        // رفع الصورة الرئيسية
        if ($request->hasFile('main_image')) {
            $magazinesData['main_image'] = $request->file('main_image')->store('magazines/main', 'public');
        }

        // رفع الصور الفرعية
        if ($request->hasFile('sub_images')) {
            $subImages = [];
            foreach ($request->file('sub_images') as $subImage) {
                $subImagePath = $subImage->store('magazines/sub', 'public');
                $subImages[] = $subImagePath;
            }
            $magazinesData['sub_image'] = json_encode($subImages);
        }

        Magazine::create($magazinesData);

        return redirect()->route('admin.magazines.index')->with('success', 'تمت إضافة الالإنجاز بنجاح!');
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
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
            'sub_images' => 'nullable|array|max:10',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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

        // تحديث الصورة الرئيسية
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

        // تحديث الصور الفرعية
        if ($request->hasFile('sub_images')) {
            // حذف الصور الفرعية القديمة
            if ($magazine->sub_image) {
                $oldSubImages = json_decode($magazine->sub_image, true);
                if (is_array($oldSubImages)) {
                    foreach ($oldSubImages as $oldImage) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }

            // رفع الصور الجديدة
            $subImages = [];
            foreach ($request->file('sub_images') as $subImage) {
                $subImagePath = $subImage->store('magazines/sub', 'public');
                $subImages[] = $subImagePath;
            }
            $magazinesData['sub_image'] = json_encode($subImages);
        }

        $magazine->update($magazinesData);

        return redirect()->route('admin.magazines.index')->with('success', 'تم تحديث الالإنجاز بنجاح!');
    }

    public function destroy(Magazine $magazine)
    {
        // حذف الصورة الرئيسية
        if ($magazine->main_image) {
            Storage::disk('public')->delete($magazine->main_image);
        }

        // حذف الصور الفرعية
        if ($magazine->sub_image) {
            $subImages = json_decode($magazine->sub_image, true);
            if (is_array($subImages)) {
                foreach ($subImages as $subImage) {
                    Storage::disk('public')->delete($subImage);
                }
            }
        }

        $magazine->delete();

        return redirect()->route('admin.magazines.index')->with('success', 'تم حذف الالإنجاز بنجاح!');
    }
}
