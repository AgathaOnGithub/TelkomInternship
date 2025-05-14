@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-purple-800 mb-6">Kotak Masuk</h2>

    <div class="bg-white shadow rounded-md">
        @foreach ($messages as $message)
        <div class="flex items-center justify-between border-b py-4 hover:bg-gray-100 px-4">
            <div class="flex flex-col">
                <span class="font-semibold text-blue-700">{{ $message->name }}</span>
                <span class="text-gray-600 text-sm">📞 {{ $message->phone ?? '-' }} | ✉️ {{ $message->email }}</span>
                <p class="text-sm text-gray-800 mt-1">{{ Str::limit($message->message, 100) }}</p>
            </div>
            <div class="text-right text-xs text-gray-500 whitespace-nowrap">
                {{ $message->created_at->format('d M Y H:i') }}
                <form action="{{ route('messages.delete', $message->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?');">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:text-red-700 ml-2">🗑 Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
        <div class="mt-4">
            {{ $messages->links() }}
        </div>

    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>
@endsection