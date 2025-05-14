@extends('layouts.app')

@section('content')
<style>
    .upload-wrapper {
        background: #fff;
        padding: 40px 30px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        max-width: 900px;
        margin: auto;
    }

    .upload-title {
        color: #5E7CC7;
        font-weight: 600;
        margin-bottom: 30px;
        font-size: 20px;
    }

    .file-upload-box {
        background-color: #F7F9FC;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #E0E0E0;
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 20px;
    }

    .upload-label {
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .upload-label small {
        color: #888;
    }

    .file-row {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .file-row input[type="file"] {
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background-color: #fff;
    }

    .upload-btn {
        background-color: #679CEB;
        color: white;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 10px;
        border: none;
        transition: 0.2s;
    }

    .upload-btn:hover {
        background-color: #5E7CC7;
    }

    .centered-upload-btn {
        margin-top: 20px;
        width: 100%;
        max-width: 300px;
    }

    .comment-section {
        margin-top: 40px;
    }

    .comment-section textarea {
        border-radius: 12px;
        resize: none;
        border: 1px solid #ccc;
    }

    .comment-section button {
        background-color: #C2C2C2;
        border: none;
        color: white;
        font-weight: 500;
        padding: 10px 16px;
        border-radius: 10px;
        width: 100%;
        margin-top: 12px;
    }

    .comment-section button:hover {
        background-color: #a0a0a0;
    }
</style>

<div class="container my-5">
    <div class="upload-wrapper">
        <div class="text-center mb-4">
            <h4 class="fw-semibold">{{ $internship->name }}</h4>
        </div>

        @auth
        {{-- ✅ SATU FORM UNTUK SEMUA INPUT --}}
        <form action="{{ route('uploads.storeUser') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="internship_id" value="{{ $internship->id }}">

            <!-- <div class="file-upload-box">
                <div class="upload-label">🏫 Instansi <small>(Nama Kampus atau Sekolah)</small></div>
                <div class="file-row">
                    <input type="text" name="university" class="form-control" placeholder="Contoh: Universitas Brawijaya" required>
                </div>
            </div>

            <div class="file-upload-box">
                <div class="upload-label">🎓 Jurusan <small>(Program Studi)</small></div>
                <div class="file-row">
                    <input type="text" name="major" class="form-control" placeholder="Contoh: Teknik Informatika" required>
                </div>
            </div> -->

            <h5 class="upload-title">📤 Upload Dokumen Persyaratan</h5>

            <div class="file-upload-box">
                <div class="upload-label">📑 CV <small>(PDF, Max 2MB)</small></div>
                <div class="file-row">
                    <input type="file" name="cv" required>
                </div>
            </div>

            <div class="file-upload-box">
                <div class="upload-label">📊 Rekap Nilai <small>(PDF, Max 2MB)</small></div>
                <div class="file-row">
                    <input type="file" name="rekap_nilai" required>
                </div>
            </div>

            <div class="file-upload-box">
                <div class="upload-label">📝 Surat Persetujuan Magang <small>(PDF, Max 2MB)</small></div>
                <div class="file-row">
                    <input type="file" name="surat_persetujuan" required>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="upload-btn centered-upload-btn">⬆️ Upload Semua Dokumen</button>
            </div>
        </form>
        @endauth
    </div>
</div>
@endsection

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notifSound = document.getElementById('notifSound');
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '🎉 {{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    notifSound.play();
                }
            });
        });
    </script>
@endif

{{-- SweetAlert2 & Audio Notifikasi --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<audio id="notifSound" src="{{ asset('sounds/notify.mp3') }}" preload="auto"></audio>
