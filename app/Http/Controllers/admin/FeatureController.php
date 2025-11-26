<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\MemberApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FeatureController extends Controller
{
     protected $targetLanguages = ['en' => 'English'];

    public function index()
    {
        $member_applications = MemberApplication::all();
        $magazines = Feature::latest()->paginate(10);
        return view('admin.feature.index', compact('magazines', 'member_applications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'main_image' => 'nullable|image|max:2048',
            'sub_images' => 'nullable|array|max:10',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description_ar' => 'required|string',
            'status' => 'required|boolean', // إضافة حقل الحالة
        ]);

        try {
            DB::beginTransaction();

            $magazineData = [
                'title_ar' => $request->title_ar,
                'description_ar' => $request->description_ar,
                'status' => $request->status, // استخدام القيمة من الطلب
            ];

            $tr = new GoogleTranslate('ar');
            $magazineModel = new Feature();

            foreach ($this->targetLanguages as $code => $name) {
                $titleColumn = 'title_' . $code;
                $descColumn = 'description_' . $code;

                try {
                    if (in_array($titleColumn, $magazineModel->getFillable())) {
                        $magazineData[$titleColumn] = $tr->setTarget($code)->translate($request->input('title_ar'));
                    }
                    if (in_array($descColumn, $magazineModel->getFillable())) {
                        $magazineData[$descColumn] = $tr->setTarget($code)->translate($request->input('description_ar'));
                    }
                } catch (\Exception $e) {
                    Log::error("Translation failed for {$code}: " . $e->getMessage());
                    $magazineData[$titleColumn] = null;
                    $magazineData[$descColumn] = null;
                }
            }

            if ($request->hasFile('main_image')) {
                $magazineData['main_image'] = $request->file('main_image')->store('features/main', 'public');
            }

            if ($request->hasFile('sub_images')) {
                $subImagesPaths = [];
                foreach ($request->file('sub_images') as $subImage) {
                    $subImagesPaths[] = $subImage->store('features/sub', 'public');
                }
                $magazineData['sub_image'] = json_encode($subImagesPaths);
            }

            Feature::create($magazineData);

            DB::commit();
            return redirect()->route('admin.feature.index')->with('success', 'تمت إضافة المجلة بنجاح!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Feature $feature)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.feature.show', compact('feature', 'targetLanguages'));
    }

    public function edit(Feature $feature)
    {
        $targetLanguages = $this->targetLanguages;
        $member_applications = MemberApplication::all();
        return view('admin.feature.edit', compact('feature', 'targetLanguages', 'member_applications'));
    }

    public function update(Request $request, Feature $magazine)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'main_image' => 'nullable|image|max:2048',
            'sub_images' => 'nullable|array|max:10',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description_ar' => 'required|string',
            'status' => 'required|boolean', // إضافة حقل الحالة
        ]);

        try {
            DB::beginTransaction();

            $magazineData = [
                'title_ar' => $request->title_ar,
                'description_ar' => $request->description_ar,
                'status' => $request->status, // استخدام القيمة من الطلب
            ];

            $tr = new GoogleTranslate('ar');
            $magazineModel = new Feature();

            foreach ($this->targetLanguages as $code => $name) {
                $titleColumn = 'title_' . $code;
                $descColumn = 'description_' . $code;

                try {
                    if (in_array($titleColumn, $magazineModel->getFillable())) {
                        $magazineData[$titleColumn] = $tr->setTarget($code)->translate($request->input('title_ar'));
                    }
                    if (in_array($descColumn, $magazineModel->getFillable())) {
                        $magazineData[$descColumn] = $tr->setTarget($code)->translate($request->input('description_ar'));
                    }
                } catch (\Exception $e) {
                    Log::error("Translation failed for {$code}: " . $e->getMessage());
                    $magazineData[$titleColumn] = null;
                    $magazineData[$descColumn] = null;
                }
            }

            if ($request->hasFile('main_image')) {
                if ($magazine->main_image) {
                    Storage::disk('public')->delete($magazine->main_image);
                }
                $magazineData['main_image'] = $request->file('main_image')->store('features/main', 'public');
            } elseif ($request->boolean('remove_main_image')) {
                if ($magazine->main_image) {
                    Storage::disk('public')->delete($magazine->main_image);
                    $magazineData['main_image'] = null;
                }
            }

            if ($request->hasFile('sub_images')) {
                if ($magazine->sub_image) {
                    $oldSubImages = json_decode($magazine->sub_image, true);
                    if (is_array($oldSubImages)) {
                        foreach ($oldSubImages as $oldImage) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }
                }
                $subImages = [];
                foreach ($request->file('sub_images') as $subImage) {
                    $subImages[] = $subImage->store('features/sub', 'public');
                }
                $magazineData['sub_image'] = json_encode($subImages);
            }

            $magazine->update($magazineData);

            DB::commit();
            return redirect()->route('admin.feature.index')->with('success', 'تم تحديث المجلة بنجاح!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Feature $feature)
    {
        if ($feature->main_image) {
            Storage::disk('public')->delete($feature->main_image);
        }

        if ($feature->sub_image) {
            $subImages = json_decode($feature->sub_image, true);
            if (is_array($subImages)) {
                foreach ($subImages as $subImage) {
                    Storage::disk('public')->delete($subImage);
                }
            }
        }

        $feature->delete();

        return redirect()->route('admin.feature.index')->with('success', 'تم حذف المجلة بنجاح!');
    }
}
