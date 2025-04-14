@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 mb-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-center text-2xl font-bold text-blue-600 mb-4">
        <i class="fas fa-tasks"></i> Tambah Tugas
    </h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div>
            <label for="title" class="block font-semibold">Judul Tugas</label>
            <input type="text" id="title" name="title" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-300" required placeholder="Masukkan judul tugas">
        </div>

        <div>
            <label for="description" class="block font-semibold">Deskripsi</label>
            <textarea id="description" name="description" rows="3" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-300" required placeholder="Deskripsi tugas"></textarea>
        </div>

        <div>
            <label for="deadline" class="block font-semibold">Batas Waktu</label>
            <input type="date" id="deadline" name="deadline" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label for="status" class="block font-semibold">Status</label>
            <select id="status" name="status" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-300">
                <option value="pending">Pending</option>
                <option value="in_progress">Sedang Dikerjakan</option>
                <option value="completed">Selesai</option>
            </select>
        </div>

        <div>
            <label for="user_id" class="block font-semibold">Pilih Peserta Magang</label>
            <select id="user_id" name="user_id" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-300" required>
                <option value="">-- Pilih Peserta --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="file" class="block font-semibold">Unggah File (PDF, DOCX, JPG, PNG)</label>
            <input type="file" id="file" name="file" accept=".pdf,.docx,.jpg,.png" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-300" required>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
