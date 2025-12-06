

<?php $__env->startSection('title', 'All Courses'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold mb-2">All Courses</h1>
    <p class="text-gray-600 dark:text-gray-400">Browse our collection of courses and start learning today</p>
</div>

<?php if($courses->isEmpty()): ?>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center">
        <p class="text-gray-500 dark:text-gray-400 text-lg">No courses available yet. Check back soon!</p>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 overflow-hidden">
                <img src="<?php echo e($course->thumbnail_url); ?>" alt="<?php echo e($course->title); ?>" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">
                        <a href="<?php echo e(route('courses.show', $course)); ?>" class="hover:text-primary">
                            <?php echo e($course->title); ?>

                        </a>
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                        By <?php echo e($course->instructor->name); ?>

                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-500 mb-3">
                        Created <?php echo e($course->created_at->format('M d, Y')); ?>

                    </p>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        <?php echo e(Str::limit($course->short_description, 120)); ?>

                    </p>
                    <a href="<?php echo e(route('courses.show', $course)); ?>" 
                       class="inline-block bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        View Course
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-8">
        <?php echo e($courses->links()); ?>

    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Judd\LMS\resources\views/courses/index.blade.php ENDPATH**/ ?>