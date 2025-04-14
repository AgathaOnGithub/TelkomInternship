@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto mt-8 px-4">
    <!-- Judul Dashboard -->
    <h2 class="text-blue-600 font-bold text-2xl text-center mb-3">Admin Dashboard</h2>
    <p class="text-center text-gray-500">Selamat datang, Nama Admin!</p>

   <!-- Kartu Informasi Pendaftar & Peserta (Horizontal) -->
    <div class="flex flex-wrap gap-4 mt-6 justify-between items-center">
        <!-- Kartu: Pendaftar -->
        <div class="flex-1 min-w-[200px] bg-white shadow-md p-4 rounded-lg text-center">
            <h5 class="text-gray-500">User</h5>
            <h3 class="text-blue-600 font-bold text-xl">{{ $jumlahPendaftar }} Users</h3>
            <i class="bi bi-people text-blue-600 text-2xl"></i>
        </div>

        <!-- Kartu: Peserta -->
        <div class="flex-1 min-w-[200px] bg-white shadow-md p-4 rounded-lg text-center">
            <h5 class="text-gray-500">Pembimbing</h5>
            <h3 class="text-green-600 font-bold text-xl">{{ $jumlahPembimbing }} Pembimbing </h3>
            <i class="bi bi-person-badge text-green-600 text-2xl"></i>
        </div>

        <!-- Tombol Tambah Program -->
        <div class="flex-1 min-w-[200px]">
            <a href="{{ route('admin.internships.create') }}" class="block bg-[#679CEB] text-white text-center font-bold py-4 px-4 rounded-lg w-full h-full">
                ➕ Tambah Program Magang
            </a>
        </div>
    </div>

    <!-- Daftar Program Magang -->
    <div class="bg-white shadow-md rounded-lg mt-6">
        <div class="bg-blue-600 text-white font-bold px-4 py-2 rounded-t-lg">
            Daftar Program Magang
        </div>
        <div class="p-4">
            <table class="w-full border border-gray-300 rounded-lg">
                <thead class="bg-[#679CEB] text-white">
                    <tr>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Deskripsi</th>
                        <th class="px-4 py-2 border">Lokasi</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($internships as $internship)
                    <tr class="text-center bg-gray-100">
                        <td class="px-4 py-2 border">{{ $internship->name }}</td>
                        <td class="px-4 py-2 border">{{ $internship->description }}</td>
                        <td class="px-4 py-2 border">{{ $internship->location }}</td>
                        <td class="px-4 py-2 border flex justify-center gap-2">
                            <!-- Tombol Lihat -->
                            <a href="{{ route('internships.show', $internship->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded flex items-center">
                                <i class="bi bi-eye mr-1"></i> Lihat
                            </a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.internships.edit', $internship->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded flex items-center">
                                <i class="bi bi-pencil mr-1"></i> Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.internships.destroy', $internship->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded flex items-center">
                                    <i class="bi bi-trash mr-1"></i> Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Daftar Pembimbing -->
    <div class="bg-white shadow-md rounded-lg mt-6">
        <div class="bg-blue-600 text-white font-bold px-4 py-2 rounded-t-lg">
            Daftar Pembimbing
        </div>
        <div class="p-4">
            <table class="w-full border border-gray-300 rounded-lg">
                <thead class="bg-[#679CEB] text-white">
                    <tr>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center bg-gray-100">
                        <td class="px-4 py-2 border">Shakila</td>
                        <td class="px-4 py-2 border">shakila@gmail.com</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-6 mt-8 text-center">
        <p class="font-inter">Jalan Mesjid No. 1 Kota Sukabumi 43111, Sukabumi, West Java</p>
        <p class="font-inter">📞 +85253000843 | 📧 @TelkomIndonesia | 🌐 @plasatelkomsukabumi</p>
    </footer>
</div>

@endsection
