<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        // Urutkan berdasarkan tanggal kegiatan (bukan created_at)
        $galleries = Gallery::orderBy('date', 'desc')->get();
        return view('gallery', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'image' => $imagePath,
            'title' => $request->title,
            'date' => $request->date,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $data = [
            'title' => $request->title,
            'date' => $request->date,
            'is_active' => $request->is_active,
        ];

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->route('gallery.index')->with('success', 'Data galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if (Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Foto galeri berhasil dihapus!');
    }
}
