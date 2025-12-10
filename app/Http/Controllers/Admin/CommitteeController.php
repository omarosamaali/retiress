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
                    $committeeModel = new Committee();

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

            Committee::create($committeeData);

            DB::commit();
            return redirect()->route('admin.committee.index')->with('success', 'تمت إضافة اللجنة بنجاح!');
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
            'description_ar' => 'required|string', // **أضف هذا لحقل الوصف**
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();
            $committeeData = [
                'name_ar' => $request->name_ar,
                'description_ar' => $request->description_ar, // **أضف هذا لبيانات التحديث**
                'status' => $request->status
            ];

            $tr = new GoogleTranslate('ar');

            foreach ($this->targetLanguages as $code => $name) {
                $titleColumn = 'name_' . $code;
                $descriptionColumn = 'description_' . $code; // **أضف هذا لعمود الوصف**

                try {
                    $committeeModel = new Committee(); // أنشئ كائن Model هنا لتجنب تكرار الكود

                    // ترجمة الاسم
                    if (in_array($titleColumn, $committeeModel->getFillable())) {
                        $committeeData[$titleColumn] = $tr->setTarget($code)->translate($request->name_ar);
                    } else {
                        Log::warning("Column {$titleColumn} not found in Committee model fillable. Skipping name translation for code: {$code}.");
                    }

                    // ترجمة الوصف
                    if (in_array($descriptionColumn, $committeeModel->getFillable())) {
                        $committeeData[$descriptionColumn] = $tr->setTarget($code)->translate($request->description_ar);
                    } else {
                        Log::warning("Column {$descriptionColumn} not found in Committee model fillable. Skipping description translation for code: {$code}.");
                    }
                } catch (\Exception $e) {
                    // في حالة فشل الترجمة لأي عمود، ضعه كـ null وسجل الخطأ
                    $committeeData[$titleColumn] = null;
                    $committeeData[$descriptionColumn] = null;
                    Log::error("Translation failed for {$code} (Committee Update): " . $e->getMessage());
                }
            }

            // معالجة الصورة (نفس الكود الأصلي)
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

            // **تحديث بيانات اللجنة**
            $committee->update($committeeData);

            DB::commit();
            return redirect()->route('admin.committee.index')->with('success', 'تم تحديث بيانات اللجنة بنجاح!');
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
