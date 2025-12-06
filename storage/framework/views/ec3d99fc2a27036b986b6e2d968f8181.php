

<?php $__env->startSection('title', 'Student Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold mb-2">Student Dashboard</h1>
    <p class="text-gray-600 dark:text-gray-400">Track your enrolled courses and progress</p>
</div>

<?php if($enrollments->isEmpty()): ?>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center">
        <p class="text-gray-500 dark:text-gray-400 text-lg mb-4">You haven't enrolled in any courses yet.</p>
        <a href="<?php echo e(route('courses.index')); ?>" 
           class="inline-block bg-primary hover:bg-blue-600 text-white px-6 py-3 rounded-md font-medium">
            Browse Courses
        </a>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-2xl font-bold mb-2"><?php echo e($enrollment->course->title); ?></h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            By <?php echo e($enrollment->course->instructor->name); ?>

                        </p>
                    </div>
                    <?php if($enrollment->completed): ?>
                        <span class="bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 px-3 py-1 rounded-full text-sm font-medium">
                            ✓ Completed
                        </span>
                    <?php else: ?>
                        <span class="bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 px-3 py-1 rounded-full text-sm font-medium">
                            In Progress
                        </span>
                    <?php endif; ?>
                </div>

                <p class="text-gray-700 dark:text-gray-300 mb-4"><?php echo e($enrollment->course->short_description); ?></p>

                <div class="flex space-x-2">
                    <a href="<?php echo e(route('courses.show', $enrollment->course)); ?>" 
                       class="bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Continue Learning
                    </a>
                    <form action="<?php echo e(route('student.courses.toggle-complete', $enrollment->course)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            <?php echo e($enrollment->completed ? 'Mark Incomplete' : 'Mark Complete'); ?>

                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Judd\LMS\resources\views/student/dashboard.blade.php ENDPATH**/ ?>