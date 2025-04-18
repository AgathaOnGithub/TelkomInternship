<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();

        // Pastikan setiap file memiliki URL yang benar
        foreach ($tasks as $task) {
            $task->file_url = asset('storage/' . $task->file_path);
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create(){
      // Ambil semua user dengan role 'user' (atau 'mahasiswa', tergantung sistemmu)
        $users = \App\Models\User::where('role', 'user')->get();

        return view('tasks.create', compact('users'));
    }

    public function grade(Request $request, Task $task)
    {
        $request->validate([
            'grade' => 'required|integer|min:0|max:100',
        ]);
        $task->grade = $request->grade;
        $task->save();
        return redirect()->back()->with('success', 'Nilai berhasil diberikan.');
    }

    // 
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'deadline' => 'required|date',
        'status' => 'required|in:pending,in_progress,completed',
        'file' => 'required|mimes:pdf,docx,jpg,png|max:2048',
        'user_id' => 'required|exists:users,id', // ← dimasukkan validasi user_id
    ]);

    // Simpan file ke storage/app/public/uploads
    $filePath = $request->file('file')->store('uploads', 'public');

    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'deadline' => $request->deadline,
        'status' => $request->status,
        'file_path' => $filePath,
        'user_id' => $request->user_id, // ← ambil user dari dropdown
    ]);

    return redirect()->route('pembimbing.dashboard')->with('success', 'Tugas berhasil ditambahkan!');
    
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|mimes:pdf,docx,jpg,png|max:2048'
        ]);

        $task->title = $request->title;
        $task->description = $request->description;

        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($task->file_path) {
                Storage::disk('public')->delete($task->file_path);
            }

            // Simpan file baru
            $filePath = $request->file('file')->store('uploads', 'public');
            $task->file_path = $filePath;
        }

        $task->save();

        return redirect()->route('pembimbing.dashboard')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->file_path) {
            Storage::disk('public')->delete($task->file_path);
        }

        $task->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
    }

    public function showFile($filename)
    {
        $filePath = storage_path("app/public/uploads/{$filename}");

        if (!file_exists($filePath)) {
            abort(404);
        }

        return Response::file($filePath, [
            'Content-Type' => mime_content_type($filePath),
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    public function uploadForm(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }
    
        return view('tasks.upload', compact('task'));
    }

    public function uploadFile(Request $request, Task $task)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,zip,png,jpg|max:2048',
        ]);

       // $task sudah otomatis diambil dari {task}
       if ($request->hasFile('file')) {
        $filename = time() . '_' . $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs('tasks', $filename, 'public');
        $task->file_path = 'tasks/' . $filename;
        $task->status = 'Completed';
        $task->save();
    }

        return redirect()->route('user.dashboard')->with('success', 'File berhasil diupload.');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));

        
    }
}

