<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->get();
        return view('program', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cover' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required|string|max:255',
        ]);

        $coverPath = $request->file('cover')->store('programs', 'public');

        Program::create([
            'cover' => $coverPath,
            'title' => $request->title,
            'short_description' => $request->short_description,
            'content' => $request->content,
        ]);

        return redirect()->route('program.index')->with('success', 'Program berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required|string|max:255',
        ]);

        $data = [
            'title' => $request->title,
            'short_description' => $request->short_description,
            'content' => $request->content,
        ];

        if ($request->hasFile('cover')) {
            if (Storage::disk('public')->exists($program->cover)) {
                Storage::disk('public')->delete($program->cover);
            }
            $data['cover'] = $request->file('cover')->store('programs', 'public');
        }

        $program->update($data);

        return redirect()->route('program.index')->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);

        if (Storage::disk('public')->exists($program->cover)) {
            Storage::disk('public')->delete($program->cover);
        }

        $program->delete();

        return redirect()->route('program.index')->with('success', 'Program berhasil dihapus!');
    }
}
