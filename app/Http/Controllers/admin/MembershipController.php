<?php

namespace App\Http\Controllers\Admin;

use App\Models\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stichoza\GoogleTranslate\GoogleTranslate;

class MembershipController extends Controller
{
    public function index()
    {
        $sections = Membership::all();
        return view('admin.membership.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.membership.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|string|unique:memberships',
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
        ]);

        try {
            $tr = new GoogleTranslate();
            $tr->setSource('ar')->setTarget('en');
            $title_en = $tr->translate($request->title_ar) ?? $request->title_ar; // Fallback to Arabic if translation fails
            $description_en = $tr->translate($request->description_ar) ?? $request->description_ar; // Fallback to Arabic
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'فشل في الترجمة: ' . $e->getMessage());
        }

        Membership::create([
            'section' => $request->section,
            'title_ar' => $request->title_ar,
            'title_en' => $title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $description_en,
        ]);

        return redirect()->route('admin.membership.index')->with('success', 'تم إضافة القسم بنجاح');
    }

    public function show(Membership $membership)
    {
        return view('admin.membership.show', compact('membership'));
    }

    public function edit(Membership $membership)
    {
        return view('admin.membership.edit', compact('membership'));
    }

    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'section' => 'required|string|unique:memberships,section,' . $membership->id,
            'title_ar' => 'required|string|max:255', // Made title_ar required
            'description_ar' => 'required|string',
        ]);

        try {
            $tr = new GoogleTranslate();
            $tr->setSource('ar')->setTarget('en');
            $title_en = $tr->translate($request->title_ar) ?? $request->title_ar; // Fallback to Arabic
            $description_en = $tr->translate($request->description_ar) ?? $request->description_ar; // Fallback to Arabic
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'فشل في الترجمة: ' . $e->getMessage());
        }

        $membership->update([
            'section' => $request->section,
            'title_ar' => $request->title_ar,
            'title_en' => $title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $description_en,
            'status' => $request->status
        ]);

        return redirect()->route('admin.membership.index')->with('success', 'تم تعديل القسم بنجاح');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route('admin.membership.index')->with('success', 'تم حذف القسم بنجاح');
    }
}
