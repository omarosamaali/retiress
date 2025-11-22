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
            'sub_image' => [], // Initialize as empty array
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

        if ($request->hasFile('main_image')) {
            $newsData['main_image'] = $request->file('main_image')->store('news/main', 'public');
        }

        if ($request->hasFile('sub_image')) {
            $newsData['sub_image'] = [];
            foreach ($request->file('sub_image') as $image) {
                $newsData['sub_image'][] = $image->store('news/sub', 'public');
            }
        }

        News::create($newsData);

        return redirect()->route('admin.news.index')->with('success', 'تمت إضافة الخبر بنجاح!');
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
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'description_ar' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_image' => 'nullable|array',
            'sub_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'created_at' => 'nullable|date',
        ]);

        $newsData = [
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
            'created_at' => $request->created_at,
            'sub_image' => $news->sub_image ?? [], // Preserve existing or initialize as empty array
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

        if ($request->hasFile('main_image')) {
            if ($news->main_image) {
                Storage::disk('public')->delete($news->main_image);
            }
            $newsData['main_image'] = $request->file('main_image')->store('news/main', 'public');
        } elseif ($request->boolean('remove_main_image')) {
            if ($news->main_image) {
                Storage::disk('public')->delete($news->main_image);
                $newsData['main_image'] = null;
            }
        }

        if ($request->hasFile('sub_image')) {
            // Delete existing sub-images if they exist and are an array
            if ($news->sub_image && is_array($news->sub_image)) {
                foreach ($news->sub_image as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            $newsData['sub_image'] = [];
            foreach ($request->file('sub_image') as $image) {
                $newsData['sub_image'][] = $image->store('news/sub', 'public');
            }
        } elseif ($request->boolean('remove_sub_image')) {
            if ($news->sub_image && is_array($news->sub_image)) {
                foreach ($news->sub_image as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            $newsData['sub_image'] = [];
        }

        $news->update($newsData);

        return redirect()->route('admin.news.index')->with('success', 'تم تحديث الخبر بنجاح!');
    }

    public function destroy(News $news)
    {
        // Delete the main image if it exists
        if ($news->main_image) {
            Storage::disk('public')->delete($news->main_image);
        }

        // Delete sub-images only if sub_image is an array and not null
        if (!is_null($news->sub_image) && is_array($news->sub_image)) {
            foreach ($news->sub_image as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'تم حذف الخبر بنجاح!');
    }


}
