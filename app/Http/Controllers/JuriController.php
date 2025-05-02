<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class JuriController extends Controller
{
    // SHOW HALAMAN PESERTA UNTUK PENILAIAN
    public function show(Pendaftaran $pendaftaran)
    {
        if(Auth::user()->role == "juri" || Auth::user()->role == "admin"){
            $datanilai = 0;
            $users = User::get(['id','name']);
            $datanilai = Nilai::where('id_peserta', $pendaftaran->id)->sum('total_score');
            $penilaians = Nilai::where('id_peserta', $pendaftaran->id)->latest()->paginate(5);
            return view('penjurian.show', compact(['pendaftaran','datanilai','penilaians','users']));
        } else {
            return back();
        }
    }

    // SIMPAN PENILAIAN
    public function penilaian(Request $request, Pendaftaran $pendaftaran)
    {
        if(Auth::user()->role == "juri" || Auth::user()->role == "admin"){
            $request->validate([
                'level' => 'required',
                'work' => 'required',
                'id_peserta' => 'required|integer',
                'id_juri' => 'required|integer',
                'penilaian' => 'required|json',
            ]);

            $penilaian = json_decode($request->penilaian, true);

            $total = collect($penilaian)->sum('score');

            Nilai::create([
                'id_peserta' => $request->id_peserta,
                'id_juri' => $request->id_juri,
                'penilaian' => $penilaian, // pastikan field ini JSON di migration
                'level' => $request->level,
                'tipe' => $request->work,
                'total_score' => $total,
            ]);

            $pendaftaran->update([
                'status' => '1',
            ]);

            return redirect()->back()->with('success', 'Penilaian berhasil disimpan.');
        } else {
            return back();
        }
    }

    // PERINTAH HAPUS NILAI
    public function destroy(Nilai $penilaian)
    {
        if(Auth::user()->role == "admin"){
            // Hapus data
            $penilaian->delete();

            return back()->with('success', 'Data penilaian berhasil dihapus.');
        } else {
            return back();
        }
    }
}
