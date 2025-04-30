<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Auth;

class JuriController extends Controller
{

    // SIMPAN PENILAIAN
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
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

        return back()->with('success', 'Selamat Pendaftaran kamu berhasil!');
    }

    // SHOW HALAMAN PESERTA UNTUK PENILAIAN
    public function show(Pendaftaran $pendaftaran)
    {
        if(Auth::user()->role == "juri"){
            return view('penjurian.show', compact('pendaftaran'));
        } else {
            return back();
        }
    }
}
