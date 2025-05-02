<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssessmentConfig;

class AssessmentConfigController extends Controller
{
    public function index()
    {
        $configs = AssessmentConfig::all()->groupBy(['jenis_karya', 'art_type']);
        return view('assessment_configs.index', compact('configs'));
    }

    public function create()
    {
        return view('assessment_configs.create');
    }

    public function store(Request $request)
    {
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
    }

    public function edit($id)
    {
        $config = AssessmentConfig::findOrFail($id);
        return view('assessment_configs.edit', compact('config'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_karya' => 'required|string',
            'level' => 'required|string',
            'art_type' => 'required|string',
            'title' => 'required|string',
            'type' => 'required|in:radio,checkbox',
            'options' => 'required|array',
            'options.*.label' => 'required|string',
            'options.*.value' => 'required|numeric'
        ]);

        $config = AssessmentConfig::findOrFail($id);
        $config->update([
            'jenis_karya' => $request->jenis_karya,
            'level' => $request->level,
            'art_type' => $request->art_type,
            'title' => $request->title,
            'type' => $request->type,
            'options' => $request->options, // Tidak perlu json_encode jika pakai $casts
        ]);

        return redirect()->route('standar-nilai.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $config = AssessmentConfig::findOrFail($id);
        $config->delete();

        return redirect()->route('standar-nilai.index')->with('success', 'Data berhasil dihapus');
    }

}
