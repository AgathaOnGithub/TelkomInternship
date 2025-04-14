

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto mt-8 px-4">
    <!-- Judul Halaman -->
    <h2 class="text-blue-600 font-bold text-2xl text-center mb-3">Dashboard Pembimbing</h2>
    <p class="text-center text-gray-500">Selamat datang, <?php echo e(Auth::user()->name); ?>!</p>

    <!-- Daftar Peserta Magang -->
    <h2 class="text-blue-600 font-bold text-2xl text-center mt-8 mb-3">Daftar Peserta Magang</h2>
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="w-full border border-gray-300 rounded-lg text-center">
            <thead class="bg-[#679CEB] text-white">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">No. Telepon</th>
                    <th class="px-4 py-2 border">Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="text-center bg-gray-100">
                        <td class="px-4 py-2 border"><?php echo e($index + 1); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($user->name); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($user->email); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($user->phone); ?></td>
                        <td class="px-4 py-2 border">
                            <?php
                                $registration = $registrations->firstWhere('user_id', $user->id);
                            ?>

                            <?php if($registration): ?>
                                <div class="flex justify-center items-center gap-2">
                                    <?php if($registration->cv): ?>
                                        <button 
                                            class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition"
                                            onclick="previewPdf('<?php echo e(asset(str_replace('public/', 'storage/', $registration->cv))); ?>')">
                                            📄 CV
                                        </button>
                                    <?php endif; ?>

                                    <?php if($registration->surat_persetujuan): ?>
                                        <button 
                                            class="bg-purple-500 text-white px-3 py-1 rounded-lg hover:bg-purple-600 transition"
                                            onclick="previewPdf('<?php echo e(asset(str_replace('public/', 'storage/', $registration->surat_persetujuan))); ?>')">
                                            📝 Surat Persetujuan
                                        </button>
                                    <?php endif; ?>

                                    <?php if($registration->rekap_nilai): ?>
                                        <button 
                                            class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition"
                                            onclick="previewPdf('<?php echo e(asset(str_replace('public/', 'storage/', $registration->rekap_nilai))); ?>')">
                                            📊 Rekap Nilai
                                        </button>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-sm text-gray-500 italic text-center">Belum upload</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    
    <!-- Daftar Tasks -->
    <h2 class="text-blue-600 font-bold text-2xl text-center mt-6">Daftar Tugas Peserta Magang</h2>
    <div class="flex justify-end mb-4">
        <a href="<?php echo e(route('tasks.create')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Tambah Task</a>
    </div>
    <div class="bg-white shadow-md rounded-lg mt-4 p-4">
        <table class="w-full border border-gray-300 rounded-lg">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Judul Task</th>
                    <th class="px-4 py-2 border">File</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Nilai</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="text-center bg-gray-100">
                        <td class="px-4 py-2 border"><?php echo e($task->user->name); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($task->title); ?></td>
                        <td class="px-4 py-2 border">
                            <?php if($task->file_path): ?>
                                <span class="text-sm text-green-600 block">📁 <?php echo e(\Carbon\Carbon::parse($task->updated_at)->format('d M Y')); ?></span>
                                <button onclick="previewPdf('<?php echo e(asset('storage/' . $task->file_path)); ?>')" class="bg-blue-500 text-white px-2 py-1 rounded">Lihat File</button>
                            <?php else: ?>
                                <span class="text-gray-500">Belum diupload</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2 border"><?php echo e(ucfirst($task->status)); ?></td>
                        <td class="px-4 py-2 border">
                            <?php if(empty($task->grade)): ?>
                                <form action="<?php echo e(route('tasks.grade', $task->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="number" name="grade" class="border px-2 py-1 rounded" min="0" max="100" required>
                                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Input Nilai</button>
                                </form>
                            <?php else: ?>
                                <?php echo e(ucfirst($task->grade)); ?>

                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2 border">
                        <div class="flex justify-center gap-2">
                            <a href="<?php echo e(route('tasks.edit', $task->id)); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded text-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="<?php echo e(route('tasks.destroy', $task->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded text-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk Preview PDF -->
<div class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 items-center justify-center" id="pdfModal">
    <div class="bg-white shadow-lg rounded-lg w-4/5 h-4/5 relative">
        <button class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-lg" onclick="closeModal()">✖</button>
        <iframe id="pdfViewer" src="" class="w-full h-full"></iframe>
    </div>
</div>

<!-- Script untuk Preview PDF -->
<script>
    function previewPdf(url) {
        document.getElementById('pdfViewer').src = url;
        document.getElementById('pdfModal').classList.remove('hidden');
        document.getElementById('pdfModal').classList.add('flex');
    }
    function closeModal() {
        document.getElementById('pdfModal').classList.add('hidden');
        document.getElementById('pdfModal').classList.remove('flex');
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\magangtelkom\resources\views/dashboard/pembimbing.blade.php ENDPATH**/ ?>