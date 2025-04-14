

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto mt-10 mb-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-center text-2xl font-bold text-blue-600 mb-4">
        <i class="fas fa-tasks"></i> Tambah Tugas
    </h2>

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('tasks.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
        <?php echo csrf_field(); ?>
        
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
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\magangtelkom\resources\views/tasks/create.blade.php ENDPATH**/ ?>