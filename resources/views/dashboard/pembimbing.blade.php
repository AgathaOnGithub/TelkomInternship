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

    <!-- Daftar Tugas Magang -->
    <div class="bg-white shadow rounded-lg p-6 mb-10">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Tugas Magang</h2>
            <a href="{{ route('tasks.create') }}"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                ➕ Tambah Tugas
            </a>
        </div>

        <table class="w-full border border-gray-300 text-center">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2 border">Program Magang</th>
                    <th class="px-4 py-2 border">Jumlah Peserta</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($internships as $internship)
                    <tr class="bg-gray-100">
                        <td class="px-4 py-2 border">{{ $internship->name }}</td>
                        <td class="px-4 py-2 border">{{ $internship->users->count() }}</td>
                        <td class="px-4 py-2 border">
                            <button onclick="toggleDetail({{ $internship->id }})"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                🔍 Lihat
                        </td>
                    </tr>

                <!-- Detail Peserta -->
                <tr id="detail-{{ $internship->id }}" class="hidden">
                    <td colspan="3" class="p-4">
                        <div class="bg-gray-50 p-4 rounded shadow-inner">
                            <h3 class="text-lg font-semibold mb-3">Peserta Program: {{ $internship->name }}</h3>
                            <table class="w-full border text-sm">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="px-3 py-1 border">Nama Peserta</th>
                                        <th class="px-3 py-1 border">Judul Tugas</th>
                                        <th class="px-3 py-1 border">File</th>
                                        <th class="px-3 py-1 border">Deadline</th>
                                        <th class="px-3 py-1 border">Nilai</th>
                                        <th class="px-3 py-1 border">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $adaPeserta = false; @endphp
                                    @forelse ($internship->users as $user)
                                        @if (strcasecmp($user->pivot->status_lowongan, 'diterima') === 0)
                                            @php $adaPeserta = true; @endphp
                                            @forelse ($user->tasks as $task)
                                                <tr>
                                                    <td class="px-3 py-1 border">{{ $user->name }}</td>
                                                    <td class="px-3 py-1 border">{{ $task->title }}</td>
                                                    <td class="px-3 py-1 border">
                                                    @if ($task->pivot && $task->pivot->file_path)
                                                        <a href="{{ asset('storage/' . $task->pivot->file_path) }}" target="_blank"
                                                            class="text-blue-600 hover:underline">📁 File</a>
                                                    @else
                                                        <span class="text-gray-500">Belum ada</span>
                                                    @endif
                                                    </td>
                                                    <td class="px-3 py-1 border">
                                                        {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : '-' }}
                                                    </td>
                                                    <td class="px-3 py-1 border">
                                                        {{ $task->grade ?? 'Belum Dinilai' }}
                                                    </td>
                                                    <td class="px-3 py-1 border flex gap-2">
                                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Yakin?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="px-3 py-1 border" colspan="5" class="text-center text-gray-500 italic">
                                                        Belum ada tugas
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-gray-500 italic">Belum ada peserta</td>
                                        </tr>
                                    @endforelse

                                    @if (!$adaPeserta)
                                        <tr>
                                            <td colspan="5" class="text-center text-gray-500 italic">Belum ada peserta yang diterima</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function toggleDetail(id) {
        const row = document.getElementById(`detail-${id}`);
        row.classList.toggle('hidden');
    }
</script>

<!-- Modal Preview PDF -->
<div class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 items-center justify-center z-50" id="pdfModal">
    <div class="bg-white shadow-lg rounded-lg w-4/5 h-4/5 relative">
        <button class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded" onclick="closeModal()">✖</button>
        <iframe id="pdfViewer" src="" class="w-full h-full rounded-b-lg"></iframe>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    function submitStatus(selectObj, userId) {
        let status = selectObj.value;

        $.ajax({
            url: '{{ route('update.status.lowongan') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userId,
                status_lowongan: status
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Status Diperbarui!',
                    text: `Status peserta telah diubah menjadi "${status}".`,
                    timer: 2500,
                    showConfirmButton: false
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengubah status.',
                    timer: 2500,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
@endsection
