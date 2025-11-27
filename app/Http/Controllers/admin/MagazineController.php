<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\MemberApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MagazineController extends Controller
{
    protected $targetLanguages = ['en' => 'English'];

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
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'nullable|image|max:2048',
            'sub_images' => 'nullable|array|max:10',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description_ar' => 'required|string',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            $magazineData = [
                'title_ar' => $request->title_ar,
                'name' => $request->name, // إضافة name
                'description_ar' => $request->description_ar,
                'status' => $request->status,
            ];

            // معالجة الـ image لو موجودة
            if ($request->hasFile('image')) {
                $magazineData['image'] = $request->file('image')->store('magazines', 'public');
            }

            $tr = new GoogleTranslate('ar');
            $magazineModel = new Magazine();

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
                $magazineData['main_image'] = $request->file('main_image')->store('magazines/main', 'public');
            }

            if ($request->hasFile('sub_images')) {
                $subImagesPaths = [];
                foreach ($request->file('sub_images') as $subImage) {
                    $subImagesPaths[] = $subImage->store('magazines/sub', 'public');
                }
                $magazineData['sub_image'] = json_encode($subImagesPaths);
            }

            Magazine::create($magazineData);

            DB::commit();
            return redirect()->route('admin.magazines.index')->with('success', 'تمت إضافة المقال بنجاح!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, Magazine $magazine)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'nullable|image|max:2048',
            'sub_images' => 'nullable|array|max:10',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description_ar' => 'required|string',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            $magazineData = [
                'title_ar' => $request->title_ar,
                'name' => $request->name,
                'description_ar' => $request->description_ar,
                'status' => $request->status,
            ];

            // معالجة الـ image
            if ($request->hasFile('image')) {
                if ($magazine->image) {
                    Storage::disk('public')->delete($magazine->image);
                }
                $magazineData['image'] = $request->file('image')->store('magazines', 'public');
            } elseif ($request->boolean('remove_image')) {
                if ($magazine->image) {
                    Storage::disk('public')->delete($magazine->image);
                    $magazineData['image'] = null;
                }
            }

            $tr = new GoogleTranslate('ar');
            $magazineModel = new Magazine();

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
                $magazineData['main_image'] = $request->file('main_image')->store('magazines/main', 'public');
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
                    $subImages[] = $subImage->store('magazines/sub', 'public');
                }
                $magazineData['sub_image'] = json_encode($subImages);
            }

            $magazine->update($magazineData);

            DB::commit();
            return redirect()->route('admin.magazines.index')->with('success', 'تم تحديث المقال بنجاح!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Magazine $magazine)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.magazines.show', compact('magazine', 'targetLanguages'));
    }

    public function edit(Magazine $magazine)
    {
        $targetLanguages = $this->targetLanguages;
        $member_applications = MemberApplication::all();
        return view('admin.magazines.edit', compact('magazine', 'targetLanguages', 'member_applications'));
    }



    public function destroy(Magazine $magazine)
    {
        if ($magazine->main_image) {
            Storage::disk('public')->delete($magazine->main_image);
        }

        if ($magazine->sub_image) {
            $subImages = json_decode($magazine->sub_image, true);
            if (is_array($subImages)) {
                foreach ($subImages as $subImage) {
                    Storage::disk('public')->delete($subImage);
                }
            }
        }

        $magazine->delete();

        return redirect()->route('admin.magazines.index')->with('success', 'تم حذف المقال بنجاح!');
    }
}
