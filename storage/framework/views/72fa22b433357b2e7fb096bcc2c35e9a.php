

<?php $__env->startSection('content'); ?>
<div class="container mx-auto mt-6 px-4">
    <h2 class="text-center text-2xl font-bold text-blue-600">Arsip Dokumen Pendaftaran</h2>
    <p class="text-center text-gray-600">Selamat datang, <?php echo e(Auth::user()->name); ?>!</p>

    <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mt-10">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                📁 <?php echo e($program->name); ?>

            </h3>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg shadow-md">
                    <thead class="bg-[#679CEB] text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-center">CV</th>
                            <th class="px-4 py-2 text-center">Surat Persetujuan</th>
                            <th class="px-4 py-2 text-center">Transkrip</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php $__currentLoopData = $program->registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2"><?php echo e($item->user->name); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->user->email); ?></td>
                            <td class="px-4 py-2 text-center">
                                <?php if($item->cv): ?>
                                <a href="<?php echo e(asset(str_replace('public/', 'storage/', $item->cv))); ?>" target="_blank"
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                                    Lihat CV
                                </a>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">Kosong</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <?php if($item->surat_persetujuan): ?>
                                <a href="<?php echo e(asset(str_replace('public/', 'storage/', $item->surat_persetujuan))); ?>" target="_blank"
                                    class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 transition">
                                    Lihat Surat
                                </a>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">Kosong</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <?php if($item->rekap_nilai): ?>
                                <a href="<?php echo e(asset(str_replace('public/', 'storage/', $item->rekap_nilai))); ?>" target="_blank"
                                    class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                    Lihat 
                                </a>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">Kosong</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-magang\resources\views/admin/arsip.blade.php ENDPATH**/ ?>