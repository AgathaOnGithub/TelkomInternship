@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4 text-center text-purple-800">Verifikasi Email</h2>

    <p class="mb-4 text-gray-700">
        Kami telah mengirimkan tautan verifikasi ke alamat email kamu.
        Jika kamu belum menerima email tersebut, kamu bisa klik tombol di bawah ini untuk meminta ulang.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="text-green-600 font-medium mb-4">
            Link verifikasi baru telah dikirim ke email kamu!
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit"
                class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
            Kirim Ulang Email Verifikasi
        </button>
    </form>
</div>
@endsection
