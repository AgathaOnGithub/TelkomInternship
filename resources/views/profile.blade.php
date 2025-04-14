@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="bg-white shadow-xl rounded-xl p-8">
        <h2 class="text-center text-3xl font-bold text-gray-800 mb-8">Profil Pengguna</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-start">
            <!-- FOTO PROFIL DAN FORM UPLOAD -->
            <div class="flex flex-col items-center">
                <!-- Foto Profil -->
                @if($user->profile_picture)
                    <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}"
                        class="w-48 h-48 object-cover rounded-full border-4 border-gray-300 shadow-lg transition-transform hover:scale-105 duration-300"
                        alt="Foto Profil">
                @else
                    <img src="{{ asset('images/profile/default.png') }}"
                        class="w-48 h-48 object-cover rounded-full border-4 border-gray-300 shadow-lg"
                        alt="Foto Profil">
                @endif

                <!-- Form Upload -->
                <form action="{{ route('profile.update-picture') }}" method="POST" enctype="multipart/form-data"
                    class="mt-6 w-full px-4 text-center space-y-3">
                    @csrf

                    <label class="block text-sm font-semibold text-gray-600">Ganti Foto Profil</label>

                    <input type="file" name="profile_picture"
                        class="w-full text-sm text-gray-600
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-medium
                            file:bg-blue-100 file:text-blue-700
                            hover:file:bg-blue-200 transition-all duration-200 ease-in-out"
                        accept="image/*" required>

                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg shadow-md transition duration-200 ease-in-out font-semibold text-sm">
                        <i class="fas fa-upload mr-1"></i> Unggah
                    </button>

                    @error('profile_picture')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    @if(session('success'))
                        <p class="text-green-600 text-sm">{{ session('success') }}</p>
                    @endif
                </form>
            </div>

            <!-- INFORMASI PENGGUNA -->
            <div class="col-span-2 space-y-5 text-gray-700">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.293.534 6.121 1.474M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Nama: {{ $user->name }}</span>
                </div>

                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 12a4 4 0 01-8 0 4 4 0 018 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14v7m0-7H8m4 0h4" />
                    </svg>
                    <span>Email: {{ $user->email }}</span>
                </div>

                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h11m0 0h2a2 2 0 012 2v5a2 2 0 01-2 2h-2m-3-9v7m0-7H8m4 0h4" />
                    </svg>
                    <span>No. Telepon: {{ $user->phone ?? 'Tidak tersedia' }}</span>
                </div>

                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 22s8-4 8-10a8 8 0 10-16 0c0 6 8 10 8 10z" />
                    </svg>
                    <span>Alamat: {{ $user->address ?? 'Tidak tersedia' }}</span>
                </div>

                <!-- INFORMASI MAGANG (JIKA ADMIN / PEMBIMBING) -->
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'pembimbing')
                    <hr class="my-4">
                    <h5 class="text-lg font-semibold text-gray-800">Informasi Magang</h5>
                    <p>Program Magang: {{ $user->internship ? $user->internship->title : 'Belum Terdaftar' }}</p>
                    <p>Status: {{ $user->internship_status ?? 'Mahasiswa' }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
