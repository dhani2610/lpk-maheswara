<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Ambil data pertama, jika kosong maka buat instance baru agar view tidak error
        $contact = Contact::first() ?? new Contact();

        return view('contact', compact('contact'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'embed_map' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        // Cari data pertama, jika tidak ada maka buat baru
        $contact = Contact::first() ?? new Contact();

        $contact->embed_map = $request->embed_map;
        $contact->address = $request->address;
        $contact->phone = $request->phone;
        $contact->email = $request->email;

        $contact->save();

        return redirect()->back()->with('success', 'Informasi Kontak berhasil diperbarui!');
    }
}
