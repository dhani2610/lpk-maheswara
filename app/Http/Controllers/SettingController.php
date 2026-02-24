<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil data pertama, jika kosong buat instance baru
        $setting = Setting::first() ?? new Setting();

        return view('setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'site_name' => 'required|string|max:255',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
        ]);

        $setting = Setting::first() ?? new Setting();

        // Handle upload logo
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }
            $setting->logo = $request->file('logo')->store('settings', 'public');
        }

        $setting->site_name = $request->site_name;
        $setting->facebook_url = $request->facebook_url;
        $setting->instagram_url = $request->instagram_url;
        $setting->youtube_url = $request->youtube_url;

        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan Website berhasil diperbarui!');
    }
}
