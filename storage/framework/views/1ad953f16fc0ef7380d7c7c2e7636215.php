

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto mt-8 px-4">
    <!-- Judul Halaman -->
    <h2 class="text-blue-600 font-bold text-2xl text-center mb-3">Profil Pembimbing</h2>
    <p class="text-center text-gray-500">Informasi pembimbing dan daftar peserta magang</p>

    <!-- Profil Pembimbing -->
    <div class="bg-white shadow-md rounded-lg p-6 flex items-center gap-6 mt-6">
        <img src="<?php echo e(isset($pembimbing) && $pembimbing->profile_picture ? asset('storage/profile_pictures/' . $pembimbing->profile_picture) : asset('images/profile/default.png')); ?>" 
             class="rounded-full border w-32 h-32" alt="Foto Profil">
        <div class="w-full">
            <table class="w-full text-left border-collapse">
                <tr>
                    <th class="text-gray-600 px-4 py-2">Nama</th>
                    <td class="font-semibold px-4 py-2"><?php echo e($pembimbing->name ?? 'Nama tidak tersedia'); ?></td>
                </tr>
                <tr>
                    <th class="text-gray-600 px-4 py-2">Role</th>
                    <td class="px-4 py-2"><?php echo e(ucfirst($pembimbing->role) ?? 'Tidak tersedia'); ?></td>
                </tr>
                <tr>
                    <th class="text-gray-600 px-4 py-2">Email</th>
                    <td class="px-4 py-2"><?php echo e($pembimbing->email ?? 'Tidak tersedia'); ?></td>
                </tr>
                <tr>
                    <th class="text-gray-600 px-4 py-2">No. Telepon</th>
                    <td class="px-4 py-2"><?php echo e($pembimbing->phone ?? 'Tidak tersedia'); ?></td>
                </tr>
                <tr>
                    <th class="text-gray-600 px-4 py-2">Major</th>
                    <td class="px-4 py-2"><?php echo e($pembimbing->major ?? 'Tidak tersedia'); ?></td>
                </tr>
                <tr>
                    <th class="text-gray-600 px-4 py-2">Universitas</th>
                    <td class="px-4 py-2"><?php echo e($pembimbing->institution ?? 'Tidak tersedia'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\magangtelkom\resources\views/pembimbing/profile.blade.php ENDPATH**/ ?>