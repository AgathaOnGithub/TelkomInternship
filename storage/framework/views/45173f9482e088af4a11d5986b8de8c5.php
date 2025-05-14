

<?php $__env->startSection('content'); ?>
<div class="container mx-auto mt-8 px-4">
    <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-blue-600">User Dashboard</h2>
        <p class="text-gray-600">Selamat datang, <?php echo e(Auth::user()->name); ?>!</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border border-gray-300 shadow-md rounded-lg">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Judul Task</th>
                    <th class="px-4 py-2 text-center">File</th>
                    <th class="px-4 py-2 text-center">Status</th>
                    <th class="px-4 py-2 text-center">Nilai</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php if(isset($tasks) && $tasks->count() > 0): ?>
                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="px-4 py-2">
                                <?php echo e($task->user->name ?? 'Tidak Ada User'); ?>

                            </td>
                            <td class="px-4 py-2">
                                <?php echo e($task->title); ?>

                            </td>
                            <td class="px-4 py-2 text-center">
                                <?php if(Auth::user()->role == 'user' && $task->user_id == Auth::id()): ?>
                                    <a href="<?php echo e(route('tasks.upload', $task)); ?>" 
                                        class="bg-blue-500 text-white px-2 py-1 rounded">
                                        <?php echo e($task->file ? 'Ganti File' : 'Upload File'); ?>

                                    </a>
                                    <?php if($task->file_path): ?>
                                        <a href="<?php echo e(asset('storage/' . $task->file_path)); ?>" 
                                        class="text-blue-600 underline ml-2" target="_blank">
                                        Lihat File
                                        </a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-red-500">Tidak ada file</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    <?php echo e($task->status == 'Completed' ? 'bg-green-500 text-white' : 'bg-yellow-400 text-gray-800'); ?>">
                                    <?php echo e(ucfirst($task->status)); ?>

                                </span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <?php if($task->grade): ?>
                                    <span class="font-bold text-green-600"><?php echo e($task->grade); ?></span>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">Belum dinilai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">
                            Tidak ada tugas yang tersedia.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\hawa\digistar\TelkomInternship\resources\views/dashboard/user.blade.php ENDPATH**/ ?>