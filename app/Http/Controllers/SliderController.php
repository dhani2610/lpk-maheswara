<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();

        return view('slider', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required',
        ]);

        $imagePath = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'image' => $imagePath,
            'label' => $request->label,
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required',
        ]);

        $data = [
            'label' => $request->label,
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->is_active,
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if (Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()->route('slider.index')->with('success', 'Slider berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if (Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('slider.index')->with('success', 'Slider berhasil dihapus!');
    }
}
