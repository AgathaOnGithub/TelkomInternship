

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    
    <div class="flex justify-center mb-8">
        <h3 class="text-2xl md:text-3xl font-bold text-blue-600 text-center">Internship Management</h3>
    </div>

    <?php if($internships->isEmpty()): ?>
        <p class="text-center text-gray-500 text-base md:text-lg">Belum ada program magang yang tersedia.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $internships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $internship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col justify-between bg-white rounded-2xl shadow-md border border-gray-100 p-5 hover:shadow-lg transition duration-300">
                    <div class="space-y-4">
                        
                        <div>
                            <h5 class="text-lg md:text-xl font-semibold text-gray-800"><?php echo e($internship->name); ?></h5>
                            <p class="text-sm text-gray-500">Telkom Indonesia</p>
                        </div>

                        <hr class="border-gray-300">

                        
                        <div class="text-sm text-gray-600 space-y-2">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                </svg>
                                <?php echo e($internship->location ?? 'Sukabumi'); ?>

                            </div>
                            <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded">
                                Work From Office
                            </span>
                        </div>

                        
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                Kuota: <?php echo e($internship->quota ?? '-'); ?>

                            </span>
                            <span class="bg-purple-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                Pelamar: <?php echo e($internship->applicants_count ?? 0); ?>

                            </span>
                        </div>

                        
                        <div class="text-sm text-gray-700 space-y-1 mt-3">
                            <p><strong>Deadline:</strong> <?php echo e(\Carbon\Carbon::parse($internship->deadline)->format('d M Y')); ?></p>
                            <p><strong>Periode:</strong> <?php echo e($internship->start_date); ?> - <?php echo e($internship->end_date); ?></p>
                            <p><strong>Onboarding:</strong> <?php echo e($internship->onboarding_date ?? '-'); ?></p>
                        </div>
                    </div>

                    
                    <div class="mt-6 text-right">
                        <a href="<?php echo e(route('internships.show', $internship->id)); ?>" 
                           class="inline-block text-blue-600 font-semibold hover:underline text-sm">
                            Lihat Selengkapnya →
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\hawa\digistar\TelkomInternship\resources\views/internships/index.blade.php ENDPATH**/ ?>