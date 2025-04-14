

<?php $__env->startSection('content'); ?>
<div class="container mx-auto mt-8 px-4">
    <h3 class="text-blue-600 font-bold text-center text-2xl mb-6">Program Magang</h3>

    <?php if($internships->isEmpty()): ?>
        <p class="text-center text-gray-500">Belum ada program magang yang tersedia.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $internships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $internship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <div class="bg-gray-100 text-gray-900 font-semibold p-2 rounded-t-lg">
                        <?php echo e($internship->name); ?>

                    </div>
                    <div class="p-3">
                        <p class="text-gray-600 text-sm"><?php echo e(Str::limit($internship->description, 120)); ?></p>
                        <a href="<?php echo e(route('internships.show', $internship->id)); ?>" class="text-blue-600 font-medium mt-2 inline-flex items-center">
                            Lihat Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\magangtelkom\resources\views/internships/index.blade.php ENDPATH**/ ?>