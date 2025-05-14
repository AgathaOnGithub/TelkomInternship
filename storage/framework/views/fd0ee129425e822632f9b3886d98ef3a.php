

<?php $__env->startSection('content'); ?>
<div class="container mx-auto max-w-lg px-4 py-10">
    <div class="bg-white shadow-xl rounded-2xl p-6">
        <h2 class="text-2xl font-bold text-blue-800 mb-6 text-center">Hubungi Kami</h2>

        
        <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        
        <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('contact.send')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="<?php echo e(old('name')); ?>"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400"
                    required>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">No. Telp</label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="<?php echo e(old('phone')); ?>"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400"
                    required>
            </div>


            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="<?php echo e(old('email')); ?>"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400"
                    required>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                <textarea
                    name="message"
                    id="message"
                    rows="5"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400"
                    required><?php echo e(old('message')); ?></textarea>
            </div>

            <div class="text-right">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
                    Kirim
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\hawa\digistar\TelkomInternship\resources\views/pages/contact.blade.php ENDPATH**/ ?>