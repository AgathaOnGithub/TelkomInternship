@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-8 px-4">
    <!-- Judul Halaman -->
    <h2 class="text-blue-600 font-bold text-2xl text-center mb-3">Dashboard Pembimbing</h2>
    <p class="text-center text-gray-500">Selamat datang, {{ Auth::user()->name }}!</p>

    <!-- Daftar Peserta Magang -->
    <h2 class="text-blue-600 font-bold text-2xl text-center mt-8 mb-3">Daftar Peserta Magang</h2>
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="w-full border border-gray-300 rounded-lg text-center">
            <thead class="bg-[#679CEB] text-white">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">No. Telepon</th>
                    <th class="px-4 py-2 border">Dokumen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr class="text-center bg-gray-100">
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ $user->phone }}</td>
                        <td class="px-4 py-2 border">
                            @php
                                $registration = $registrations->firstWhere('user_id', $user->id);
                            @endphp

                            @if ($registration)
                                <div class="flex justify-center items-center gap-2">
                                    @if ($registration->cv)
                                        <button 
                                            class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition"
                                            onclick="previewPdf('{{ asset(str_replace('public/', 'storage/', $registration->cv)) }}')">
                                            📄 CV
                                        </button>
                                    @endif

                                    @if ($registration->surat_persetujuan)
                                        <button 
                                            class="bg-purple-500 text-white px-3 py-1 rounded-lg hover:bg-purple-600 transition"
                                            onclick="previewPdf('{{ asset(str_replace('public/', 'storage/', $registration->surat_persetujuan)) }}')">
                                            📝 Surat Persetujuan
                                        </button>
                                    @endif

                                    @if ($registration->rekap_nilai)
                                        <button 
                                            class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition"
                                            onclick="previewPdf('{{ asset(str_replace('public/', 'storage/', $registration->rekap_nilai)) }}')">
                                            📊 Rekap Nilai
                                        </button>
                                    @endif
                                </div>
                            @else
                                <p class="text-sm text-gray-500 italic text-center">Belum upload</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Daftar Tasks -->
    <h2 class="text-blue-600 font-bold text-2xl text-center mt-6">Daftar Tugas Peserta Magang</h2>
    <div class="flex justify-end mb-4">
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Tambah Task</a>
    </div>
    <div class="bg-white shadow-md rounded-lg mt-4 p-4">
        <table class="w-full border border-gray-300 rounded-lg">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Judul Task</th>
                    <th class="px-4 py-2 border">File</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Nilai</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="text-center bg-gray-100">
                        <td class="px-4 py-2 border">{{ $task->user->name }}</td>
                        <td class="px-4 py-2 border">{{ $task->title }}</td>
                        <td class="px-4 py-2 border">
                            @if ($task->file_path)
                                <span class="text-sm text-green-600 block">📁 {{ \Carbon\Carbon::parse($task->updated_at)->format('d M Y') }}</span>
                                <button onclick="previewPdf('{{ asset('storage/' . $task->file_path) }}')" class="bg-blue-500 text-white px-2 py-1 rounded">Lihat File</button>
                            @else
                                <span class="text-gray-500">Belum diupload</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border">{{ ucfirst($task->status) }}</td>
                        <td class="px-4 py-2 border">
                            @if (empty($task->grade))
                                <form action="{{ route('tasks.grade', $task->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="grade" class="border px-2 py-1 rounded" min="0" max="100" required>
                                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Input Nilai</button>
                                </form>
                            @else
                                {{ ucfirst($task->grade) }}
                            @endif
                        </td>
                        <td class="px-4 py-2 border">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded text-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded text-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk Preview PDF -->
<div class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 items-center justify-center" id="pdfModal">
    <div class="bg-white shadow-lg rounded-lg w-4/5 h-4/5 relative">
        <button class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-lg" onclick="closeModal()">✖</button>
        <iframe id="pdfViewer" src="" class="w-full h-full"></iframe>
    </div>
</div>

<!-- Script untuk Preview PDF -->
<script>
    function previewPdf(url) {
        document.getElementById('pdfViewer').src = url;
        document.getElementById('pdfModal').classList.remove('hidden');
        document.getElementById('pdfModal').classList.add('flex');
    }
    function closeModal() {
        document.getElementById('pdfModal').classList.add('hidden');
        document.getElementById('pdfModal').classList.remove('flex');
    }
</script>
@endsection
