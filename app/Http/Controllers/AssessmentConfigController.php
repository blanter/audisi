<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssessmentConfig;
use Auth;

class AssessmentConfigController extends Controller
{
    // INDEX HALAMAN STANDAR NILAI
    public function index(Request $request)
    {
        if(Auth::user()->role == "admin"){
            $query = AssessmentConfig::query();

            // Filter berdasarkan kata kunci (nama atau judul)
            if ($request->filled('q')) {
                $search = $request->input('q');
                $query->where(function ($q) use ($search) {
                    $q->where('art_type', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%');
                });
            }

            // Filter berdasarkan jenis_karya
            if ($request->filled('jenis_karya')) {
                $query->where('jenis_karya', $request->input('jenis_karya'));
            }

            $configs = $query->get()->groupBy(['jenis_karya', 'art_type']);

            return view('assessment_configs.index', compact('configs'));
        } else {
            return back();
        }
    }

    // HALAMAN TAMBAH STANDAR
    public function create()
    {
        return view('assessment_configs.create');
    }

    // SIMPAN DATA STANDAR NILAI
    public function store(Request $request)
    {
        if(Auth::user()->role == "admin"){
            $data = $request->validate([
                'jenis_karya' => 'required|string',
                'level' => 'required|string',
                'art_type' => 'required|string',
                'title' => 'required|string',
                'type' => 'required|in:radio,checkbox',
                'options' => 'required|json',
            ]);
            
            $data['options'] = json_decode($data['options'], true);
            AssessmentConfig::create($data);
            return redirect()->route('standar-nilai.index');
        } else {
            return back();
        }
    }

    // HALAMAN EDIT STANDAR NILAI
    public function edit($id)
    {
        $config = AssessmentConfig::findOrFail($id);
        return view('assessment_configs.edit', compact('config'));
    }

    // PERBARUI DATA STANDAR NILAI
    public function update(Request $request, $id)
    {
        if(Auth::user()->role == "admin"){
            // Decode the JSON string from the form into an array
            $options = json_decode($request->input('options'), true);
        
            // Manually merge into request so validation sees the correct structure
            $request->merge(['options' => $options]);
        
            $request->validate([
                'jenis_karya' => 'required|string',
                'level' => 'required|string',
                'art_type' => 'required|string',
                'title' => 'required|string',
                'type' => 'required|in:radio,checkbox',
                'options' => 'required|array',
                'options.*.label' => 'required|string',
                'options.*.value' => 'required|numeric',
            ]);
        
            $config = AssessmentConfig::findOrFail($id);
            $config->update([
                'jenis_karya' => $request->jenis_karya,
                'level' => $request->level,
                'art_type' => $request->art_type,
                'title' => $request->title,
                'type' => $request->type,
                'options' => $request->options,
            ]);
        
            return redirect()->route('standar-nilai.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return back();
        }
    }    

    // HAPUS DATA STANDAR NILAI
    public function destroy($id)
    {
        if(Auth::user()->role == "admin"){
            $config = AssessmentConfig::findOrFail($id);
            $config->delete();

            return redirect()->route('standar-nilai.index')->with('success', 'Data berhasil dihapus');
        } else {
            return back();
        }
    }

}
