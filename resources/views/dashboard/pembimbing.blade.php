@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg mt-4 p-4">
        <h2 class="text-blue-600 font-bold text-2xl text-center mb-3">Dashboard Pembimbing</h2>
        <p class="text-center text-gray-500">Selamat datang, {{ Auth::user()->name }}!</p>

        <!-- Form Search -->
        <form method="GET" action="{{ route('pembimbing.dashboard') }}" class="mb-4">
            <select name="search" class="border p-2 rounded" onchange="this.form.submit()">
                <option value="">-- Pilih Posisi --</option>
                @foreach ($positions as $position)
                    <option value="{{ $position }}" {{ request('search') == $position ? 'selected' : '' }}>
                        {{ $position }}
                    </option>
                @endforeach
            </select>
        </form> 

        <table class="w-full border border-gray-300 rounded-lg text-center">
            <thead class="bg-[#679CEB] text-white">
                <tr>
                    <th class="px-4 py-2 border">NO</th>
                    <th class="px-4 py-2 border">Nama Peserta</th>
                    <th class="px-4 py-2 border">Instansi</th>
                    <th class="px-4 py-2 border">Jurusan</th>
                    <th class="px-4 py-2 border">Periode</th>
                    <th class="px-4 py-2 border">Status Lowongan</th>
                    <th class="px-4 py-2 border">Dokumen</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $index => $user)
                @php
                    $registration = $registrations->firstWhere('user_id', $user->id);
                @endphp
                <tr class="text-center bg-gray-100">
                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">
                        <!-- Nama dan Email dalam satu kolom -->
                        <div>
                            <span class="font-semibold">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-2 border">{{ $user->institution }}</td>
                    <td class="px-4 py-2 border">{{ $user->major }}</td>
                    <td class="px-4 py-2 border">
                        @if ($registration && $registration->internship)
                            {{ \Carbon\Carbon::parse($registration->internship->start_date)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($registration->internship->end_date)->format('d M Y') }}
                        @else
                            <span class="text-gray-500 italic">Belum ditentukan</span>
                        @endif
                    </td>
                    
                    <td class="px-4 py-2 border">
                        <div class="flex flex-col items-center gap-1">
                            @php
                                // Ambil registrasi berdasarkan user_id
                                $registration = $registrations->firstWhere('user_id', $user->id);
                                $status = $registration ? $registration->status_lowongan : 'Belum Ditentukan';
                            @endphp

                            {{-- Status badge pakai data dari $registration --}}
                            <span id="status-badge-{{ $user->id }}" class="text-xs font-semibold px-2 py-1 rounded
                                {{ $status == 'Diterima' ? 'bg-green-500 text-white' :
                                ($status == 'Ditolak' ? 'bg-red-500 text-white' : 'bg-gray-400 text-white') }}">
                                {{ $status }}
                            </span>
                        </div>
                    </td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('pembimbing.users.show', $registration->user->id) }}"
                        class="bg-blue-500 text-white text-sm px-2 py-0.5 rounded hover:bg-blue-400 whitespace-nowrap">
                            Lihat
                        </a>
                    </td>
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