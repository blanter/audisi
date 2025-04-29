<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::latest()->get();
        return view('pendaftaran.index', compact('pendaftarans'));
    }

    public function create()
    {
        return view('pendaftaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_karya' => 'required|in:Stage,Showcase,Video',
            'tema' => 'required|in:alam,sosial,english,forum,campuran',
            'storyboard' => 'required|image|max:8192',
            'penilaian_guru' => 'required|image|max:8192',
            'perkiraan_durasi' => 'required|string|max:255',
            'list_prop' => 'required|string',
        ]);

        $validated['storyboard_path'] = $request->file('storyboard')->store('storyboards', 'public');
        $validated['penilaian_guru_path'] = $request->file('penilaian_guru')->store('penilaian_guru', 'public');

        Pendaftaran::create($validated);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil!');
    }

    public function show(Pendaftaran $pendaftaran)
    {
        return view('pendaftaran.show', compact('pendaftaran'));
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        return view('pendaftaran.edit', compact('pendaftaran'));
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_karya' => 'required|in:Stage,Showcase,Video',
            'tema' => 'required|in:alam,sosial,english,forum,campuran',
            'storyboard' => 'nullable|image|max:8192',
            'penilaian_guru' => 'nullable|image|max:8192',
            'perkiraan_durasi' => 'required|string|max:255',
            'list_prop' => 'required|string',
        ]);

        if ($request->hasFile('storyboard')) {
            $validated['storyboard_path'] = $request->file('storyboard')->store('storyboards', 'public');
        }

        if ($request->hasFile('penilaian_guru')) {
            $validated['penilaian_guru_path'] = $request->file('penilaian_guru')->store('penilaian_guru', 'public');
        }

        $pendaftaran->update($validated);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diperbarui!');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        // Hapus file lama jika ada
        if ($pendaftaran->storyboard_path) {
            \Storage::disk('public')->delete($pendaftaran->storyboard_path);
        }
        if ($pendaftaran->penilaian_guru_path) {
            \Storage::disk('public')->delete($pendaftaran->penilaian_guru_path);
        }

        // Hapus data
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
