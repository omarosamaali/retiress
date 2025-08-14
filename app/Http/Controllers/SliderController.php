<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'quote_ar' => 'required|string',
            'is_active' => 'boolean',
        ]);

        Slider::create($request->all());

        return redirect()->route('sliders.index')->with('success', 'تم إضافة الشريحة بنجاح');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'quote_ar' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $slider->update($request->all());

        return redirect()->route('sliders.index')->with('success', 'تم تحديث الشريحة بنجاح');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'تم حذف الشريحة بنجاح');
    }
}
