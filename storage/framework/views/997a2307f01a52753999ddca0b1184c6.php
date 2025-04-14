

<?php $__env->startSection('content'); ?>
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
            <h4 class="fw-semibold"><?php echo e($internship->name); ?></h4>
        </div>

        <?php if(auth()->guard()->check()): ?>
        <h5 class="upload-title">📤 Upload Dokumen Persyaratan</h5>

        <form action="<?php echo e(route('uploads.storeUser')); ?>" method="POST" enctype="multipart/form-data">
            
        
        <input type="hidden" name="internship_id" value="<?php echo e($internship->id); ?>">
            <?php echo csrf_field(); ?>

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

        
        <div class="comment-section">
            <h5 class="upload-title">💬 Tambahkan Komentar</h5>
            <form action="<?php echo e(route('internships.addComment', $internship->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <textarea class="form-control" name="comment" id="comment" rows="4" placeholder="Tulis komentar Anda di sini..." required></textarea>
                <button type="submit">➕ Tambahkan Komentar</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php if(session('success')): ?>
    <div style="
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 30vh;
    ">
        <div style="
            background-color: #d4edda;
            color: #155724;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            max-width: 400px;
        ">
            <h4 style="margin-bottom: 10px;">🎉 Berhasil!</h4>
            <p style="margin-bottom: 15px;"><?php echo e(session('success')); ?></p>
            
            <a href="<?php echo e(route('internships.index')); ?>" 
               style="
                   background-color: #28a745;
                   color: white;
                   padding: 10px 20px;
                   border-radius: 5px;
                   text-decoration: none;
                   font-weight: bold;
               ">
               Kembali ke Halaman Magang
            </a>
        </div>
    </div>
<?php endif; ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\magangtelkom\resources\views/internships/register.blade.php ENDPATH**/ ?>