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
            'description_ar' => 'required|string', // تأكد أن النوع مطابق لقاعدة البيانات (longText أو text)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // nullable إذا لم تكن الصورة إجبارية
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();
            $committeeData = [
                'name_ar' => $request->name_ar,
                'description_ar' => $request->description_ar,
                'status' => $request->status
            ];

            $tr = new GoogleTranslate('ar');

            foreach ($this->targetLanguages as $code => $name) {
                $titleColumn = 'name_' . $code;
                $descriptionColumn = 'description_' . $code;

                try {
                    $committeeModel = new Council();

                    if (in_array($titleColumn, $committeeModel->getFillable())) {
                        $committeeData[$titleColumn] = $tr->setTarget($code)->translate($request->name_ar);
                    } else {
                        Log::warning("Column {$titleColumn} not found in Committee model fillable. Skipping name translation for code: {$code}.");
                    }

                    if (in_array($descriptionColumn, $committeeModel->getFillable())) {
                        $committeeData[$descriptionColumn] = $tr->setTarget($code)->translate($request->description_ar);
                    } else {
                        Log::warning("Column {$descriptionColumn} not found in Committee model fillable. Skipping description translation for code: {$code}.");
                    }
                } catch (\Exception $e) {
                    $committeeData[$titleColumn] = null;
                    $committeeData[$descriptionColumn] = null;
                    Log::error("Translation failed for {$code} (Committee Store): " . $e->getMessage());
                }
            }

            if ($request->hasFile('image')) {
                $committeeData['image'] = $request->file('image')->store('committees/main', 'public');
            }

            Council::create($committeeData);

            DB::commit();
            return redirect()->route('admin.council.index')->with('success', 'تمت إضافة اللجنة بنجاح!');
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
            'description_ar' => 'required|string', // أضف هذا
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();
            $councilData = [
                'name_ar' => $request->name_ar,
                'description_ar' => $request->description_ar, // أضف هذا
                'status' => $request->status
            ];

            $tr = new GoogleTranslate('ar');

            foreach ($this->targetLanguages as $code => $name) {
                $titleColumn = 'name_' . $code;
                $descriptionColumn = 'description_' . $code; // أضف هذا لعمود الوصف

                try {
                    $councilModel = new Council(); // أنشئ كائن Model هنا لتجنب تكرار الكود

                    // ترجمة الاسم
                    if (in_array($titleColumn, $councilModel->getFillable())) {
                        $councilData[$titleColumn] = $tr->setTarget($code)->translate($request->name_ar);
                    } else {
                        Log::warning("Column {$titleColumn} not found in Council model fillable. Skipping name translation for code: {$code}.");
                    }

                    // ترجمة الوصف
                    if (in_array($descriptionColumn, $councilModel->getFillable())) {
                        $councilData[$descriptionColumn] = $tr->setTarget($code)->translate($request->description_ar);
                    } else {
                        Log::warning("Column {$descriptionColumn} not found in Council model fillable. Skipping description translation for code: {$code}.");
                    }
                } catch (\Exception $e) {
                    // في حالة فشل الترجمة لأي عمود، ضعه كـ null وسجل الخطأ
                    $councilData[$titleColumn] = null;
                    $councilData[$descriptionColumn] = null;
                    Log::error("Translation failed for {$code} (Council Update): " . $e->getMessage());
                }
            }

            // معالجة الصورة (نفس الكود الأصلي)
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

            // تحديث بيانات المجلس
            $council->update($councilData);

            DB::commit();
            return redirect()->route('admin.council.index')->with('success', 'تم تحديث بيانات المجلس بنجاح!'); // رسالة نجاح أوضح
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
