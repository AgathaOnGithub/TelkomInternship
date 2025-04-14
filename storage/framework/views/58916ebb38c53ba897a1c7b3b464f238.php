

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">Profil Pengguna</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Foto Profil -->
            <div class="flex flex-col items-center">
                <?php if($user->profile_picture): ?>
                    <img src="<?php echo e(asset('storage/profile_pictures/' . $user->profile_picture)); ?>" 
                        class="w-32 h-32 object-cover rounded-full border-4 border-gray-300 shadow-md" 
                        alt="Foto Profil">
                <?php else: ?>
                    <img src="<?php echo e(asset('images/profile/default.png')); ?>" 
                        class="w-32 h-32 object-cover rounded-full border-4 border-gray-300 shadow-md" 
                        alt="Foto Profil">
                <?php endif; ?>
                <p class="mt-4 text-lg font-semibold text-gray-700"><?php echo e($user->name); ?></p>
            </div>

            <!-- Informasi Pribadi -->
            <div class="col-span-2">
                <div class="space-y-4 text-gray-700">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" 
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M16 12a4 4 0 01-8 0 4 4 0 018 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M12 14v7m0-7H8m4 0h4"/>
                        </svg>
                        <span>Email: <?php echo e($user->email); ?></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" 
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M3 10h11m0 0h2a2 2 0 012 2v5a2 2 0 01-2 2h-2m-3-9v7m0-7H8m4 0h4"/>
                        </svg>
                        <span>No. Telepon: <?php echo e($user->phone ?? 'Tidak tersedia'); ?></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" 
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M12 22s8-4 8-10a8 8 0 10-16 0c0 6 8 10 8 10z"/>
                        </svg>
                        <span>Alamat: <?php echo e($user->address ?? 'Tidak tersedia'); ?></span>
                    </div>
                </div>

                <!-- Informasi Magang (Jika Admin/Pembimbing) -->
                <?php if(auth()->user()->role == 'admin' || auth()->user()->role == 'pembimbing'): ?>
                    <hr class="my-4">
                    <h5 class="text-lg font-semibold text-gray-800">Informasi Magang</h5>
                    <p class="text-gray-700">Program Magang: 
                        <?php echo e($user->internship ? $user->internship->title : 'Belum Terdaftar'); ?></p>
                    <p class="text-gray-700">Status: <?php echo e($user->internship_status ?? 'Mahasiswa'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\magangtelkom\resources\views/profile.blade.php ENDPATH**/ ?>