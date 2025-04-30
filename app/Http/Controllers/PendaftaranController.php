<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Auth;

class PendaftaranController extends Controller
{
    // HALAMAN PESERTA AUDISI
    public function index(Request $request)
    {
        $query = Pendaftaran::query();

        if ($request->filled('jenis_karya')) {
            $query->where('jenis_karya', $request->jenis_karya);
        }

        if ($request->filled('tema')) {
            $query->where('tema', $request->tema);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->q . '%')
                  ->orWhere('judul', 'like', '%' . $request->q . '%');
            });
        }

        $pendaftarans = $query->latest()->paginate(5);

        return view('pendaftaran.index', compact('pendaftarans'));
    }

    // HALAMAN PENDAFTARAN AUDISI
    public function create()
    {
        return view('pendaftaran.create');
    }

    // PERINTAH SIMPAN PENDAFTARAN
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

        return redirect()->route('pendaftaran.success')->with('success', 'Selamat Pendaftaran kamu berhasil!');
    }

    // HALAMAN PENDAFTARAN BERHASIL
    public function success()
    {
        return view('pendaftaran.success');
    }

    // HALAMAN DETAIL PESERTA
    public function show(Pendaftaran $pendaftaran)
    {
        return view('pendaftaran.show', compact('pendaftaran'));
    }

    // HALAMAN EDIT PENDAFTARAN
    public function edit(Pendaftaran $pendaftaran)
    {
        if(Auth::user()->role == "admin"){
            return view('pendaftaran.edit', compact('pendaftaran'));
        } else {
            return back();
        }
    }

    // PERINTAH UPDATE PENDAFTARAN
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        if(Auth::user()->role == "admin"){
            $validated = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'judul' => 'required|string|max:255',
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
        } else {
            return back();
        }
    }

    // PERINTAH HAPUS PENDAFTARAN
    public function destroy(Pendaftaran $pendaftaran)
    {
        if(Auth::user()->role == "admin"){
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
        } else {
            return back();
        }
    }

    // PERINTAH CHECKMARK PESERTA
    public function check(Request $request, Pendaftaran $pendaftaran)
    {
        $pendaftaran->update([
            'status' => '1',
        ]);
        return back()->with('success', 'Berhasil check selesai audisi!');
    }
}
