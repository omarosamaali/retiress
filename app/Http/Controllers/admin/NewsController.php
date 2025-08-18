<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
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

        $newsData = [
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $descColumn = 'description_' . $code;
            try {
                if (in_array($titleColumn, (new News())->getFillable())) {
                    $newsData[$titleColumn] = $tr->setTarget($code)->translate($request->input('title_ar'));
                    $newsData[$descColumn] = $tr->setTarget($code)->translate($request->input('description_ar'));
                } else {
                    Log::warning("Columns {$titleColumn} or {$descColumn} not found in News model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $newsData[$titleColumn] = null;
                $newsData[$descColumn] = null;
                Log::error("Translation failed for {$code} (News Store): " . $e->getMessage());
            }
        }

        // ✅ رفع الصورة الرئيسية داخل public/uploads/news/main
        if ($request->hasFile('main_image')) {
            $filename = time() . '_' . uniqid() . '.' . $request->main_image->getClientOriginalExtension();
            $request->file('main_image')->move(public_path('uploads/news/main'), $filename);
            $newsData['main_image'] = 'uploads/news/main/' . $filename;
        }

        // ✅ رفع الصور الفرعية داخل public/uploads/news/sub
        if ($request->sub_image) {
            $newsData['sub_image'] = [];
            foreach ($request->sub_image as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/news/sub'), $filename);
                $newsData['sub_image'][] = 'uploads/news/sub/' . $filename;
            }
        }

        News::create($newsData);

        return redirect()->route('admin.news.index')->with('success', 'تمت إضافة الخبر بنجاح!');
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_image' => 'nullable|array',
            'sub_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $newsData = [
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $descColumn = 'description_' . $code;
            try {
                if (in_array($titleColumn, (new News())->getFillable())) {
                    $newsData[$titleColumn] = $tr->setTarget($code)->translate($request->input('title_ar'));
                    $newsData[$descColumn] = $tr->setTarget($code)->translate($request->input('description_ar'));
                } else {
                    Log::warning("Columns {$titleColumn} or {$descColumn} not found in News model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $newsData[$titleColumn] = null;
                $newsData[$descColumn] = null;
                Log::error("Translation failed for {$code} (News Update): " . $e->getMessage());
            }
        }

        // ✅ تحديث الصورة الرئيسية
        if ($request->hasFile('main_image')) {
            if ($news->main_image && file_exists(public_path($news->main_image))) {
                unlink(public_path($news->main_image));
            }

            $filename = time() . '_' . uniqid() . '.' . $request->main_image->getClientOriginalExtension();
            $request->file('main_image')->move(public_path('uploads/news/main'), $filename);
            $newsData['main_image'] = 'uploads/news/main/' . $filename;
        } elseif ($request->boolean('remove_main_image')) {
            if ($news->main_image && file_exists(public_path($news->main_image))) {
                unlink(public_path($news->main_image));
            }
            $newsData['main_image'] = null;
        }

        // ✅ تحديث الصور الفرعية
        if ($request->sub_image) {
            if ($news->sub_image) {
                foreach ($news->sub_image as $image) {
                    if (file_exists(public_path($image))) {
                        unlink(public_path($image));
                    }
                }
            }

            $newsData['sub_image'] = [];
            foreach ($request->sub_image as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/news/sub'), $filename);
                $newsData['sub_image'][] = 'uploads/news/sub/' . $filename;
            }
        } elseif ($request->boolean('remove_sub_image')) {
            if ($news->sub_image) {
                foreach ($news->sub_image as $image) {
                    if (file_exists(public_path($image))) {
                        unlink(public_path($image));
                    }
                }
            }
            $newsData['sub_image'] = null;
        }

        $news->update($newsData);

        return redirect()->route('admin.news.index')->with('success', 'تم تحديث الخبر بنجاح!');
    }

    public function show(News $news)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.news.show', compact('news', 'targetLanguages'));
    }

    public function edit(News $news)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.news.edit', compact('news', 'targetLanguages'));
    }


    public function destroy(News $news)
    {
        if ($news->main_image) {
            Storage::disk('public')->delete($news->main_image);
        }

        foreach ($news->sub_image as $image) {
            Storage::disk('public')->delete($image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'تم حذف الخبر بنجاح!');
    }
}
