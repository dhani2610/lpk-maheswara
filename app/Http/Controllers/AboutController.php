<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        // Ambil data pertama. Jika belum ada, buat instance kosong agar view tidak error
        $about = About::first() ?? new About();

        return view('about', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'nullable|string',
            'checklists' => 'nullable|array',
            'checklists.*' => 'nullable|string'
        ]);

        // Cari data pertama, jika tidak ada maka buat baru
        $about = About::first() ?? new About();

        // Handle upload gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            $about->image = $request->file('image')->store('about', 'public');
        }

        // Filter array checklist agar tidak ada yang kosong/null jika user tidak sengaja klik tambah tapi tidak diisi
        $cleanChecklists = array_filter($request->checklists ?? [], function($value) {
            return !is_null($value) && $value !== '';
        });

        $about->content = $request->content;
        $about->checklists = array_values($cleanChecklists); // Re-index array
        $about->save();

        return redirect()->back()->with('success', 'Data Tentang Kami berhasil diperbarui!');
    }
}
