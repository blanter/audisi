<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // INDEX TASK LIST
    public function index(Request $request)
    {
        $query = Task::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_panitia', 'like', "%{$search}%")
                ->orWhere('nama_task', 'like', "%{$search}%")
                ->orWhere('penanggung_jawab', 'like', "%{$search}%");
            });
        }

        $tasks = $query->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    // TAMBAH TASK
    public function create()
    {
        return view('tasks.create');
    }

    // SIMPAN TASK
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_panitia' => 'required|string|max:255',
            'nama_task' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'anggota' => 'nullable|string',
            'deskripsi' => 'required|array',
            'deskripsi.*.judul' => 'required|string',
            'deskripsi.*.status' => 'required',
        ]);

        // Pisahkan anggota dari input teks menjadi array
        $anggotaArray = array_filter(array_map('trim', explode(',', $request->anggota)));

        // Simpan task
        Task::create([
            'nama_panitia' => $validated['nama_panitia'],
            'nama_task' => $validated['nama_task'],
            'penanggung_jawab' => $validated['penanggung_jawab'],
            'anggota' => $anggotaArray,
            'deskripsi' => $validated['deskripsi'],
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil ditambahkan.');
    }

    // UPDATE STATUS
    public function updateDeskripsiStatus(Request $request, Task $task, $index)
    {
        $deskripsi = $task->deskripsi;

        if (!isset($deskripsi[$index])) {
            return response()->json(['message' => 'Item tidak ditemukan'], 404);
        }

        $deskripsi[$index]['status'] = $request->input('status') === 'done' ? 'done' : 'progress';

        $task->deskripsi = $deskripsi;
        $task->save();

        return response()->json(['message' => 'Status diperbarui']);
    }
    
    // EDIT TASK
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // UPDATE TASK
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'nama_panitia' => 'required|string|max:255',
            'nama_task' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'anggota' => 'nullable|array',
            'anggota.*' => 'string',
        ]);

        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task berhasil diperbarui.');
    }

    // HAPUS TASK
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus.');
    }
}
