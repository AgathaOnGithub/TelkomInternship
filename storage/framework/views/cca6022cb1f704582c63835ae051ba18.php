

<?php $__env->startSection('content'); ?>
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-lg p-6 rounded-xl w-full max-w-2xl">
        <h2 class="text-center text-2xl font-bold text-red-600 mb-4">Edit Program Magang</h2>

        <?php if($errors->any()): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.internships.update', $internship->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label for="name" class="block font-semibold">Nama Program</label>
                <input type="text" name="name" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                       value="<?php echo e(old('name', $internship->name)); ?>" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-semibold">Deskripsi</label>
                <textarea name="description" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                          rows="3" required><?php echo e(old('description', $internship->description)); ?></textarea>
            </div>

            <div class="mb-4">
                <label for="location" class="block font-semibold">Lokasi</label>
                <input type="text" name="location" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                       value="<?php echo e(old('location', $internship->location)); ?>" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Persyaratan</label>
                <textarea name="requirements" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Masukkan persyaratan" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Kualifikasi</label>
                <textarea name="qualification" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Masukkan kualifikasi" required></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="start_date" class="block font-semibold">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                           value="<?php echo e(old('start_date', $internship->start_date)); ?>" required>
                </div>

                <div>
                    <label for="end_date" class="block font-semibold">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                           value="<?php echo e(old('end_date', $internship->end_date)); ?>" required>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-bold transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\magangtelkom\resources\views/internships/edit.blade.php ENDPATH**/ ?>