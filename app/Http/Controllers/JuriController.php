<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Showcase;
use Illuminate\Http\Request;
use Auth;

class JuriController extends Controller
{

    // SIMPAN PENILAIAN SHOWCASE
    public function showcase(Request $request)
    {
        $data = $request->all();
        $total = array_sum(array_map(fn($v) => (int) $v['score'], $request->penilaian));

        Showcase::create([
            'id_peserta' => $data['id_peserta'],
            'id_juri' => $data['id_juri'],
            'penilaian' => $data['penilaian'],
            'total_score' => $total,
        ]);

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan.');
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
