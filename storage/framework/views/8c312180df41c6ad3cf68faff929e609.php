<?php $__env->startSection('title', 'My Bookmarks'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold mb-2">My Bookmarked Courses</h1>
    <p class="text-gray-600 dark:text-gray-400">Courses you've saved for later</p>
</div>

<?php if($bookmarkedCourses->isEmpty()): ?>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center">
        <p class="text-gray-500 dark:text-gray-400 text-lg mb-4">You haven't bookmarked any courses yet.</p>
        <a href="<?php echo e(route('courses.index')); ?>" 
           class="inline-block bg-primary hover:bg-blue-600 text-white px-6 py-3 rounded-md font-medium">
            Browse Courses
        </a>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $bookmarkedCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 overflow-hidden">
                <img src="<?php echo e($course->thumbnail_url); ?>" alt="<?php echo e($course->title); ?>" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">
                        <a href="<?php echo e(route('courses.show', $course)); ?>" class="hover:text-primary">
                            <?php echo e($course->title); ?>

                        </a>
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        By <?php echo e($course->instructor->name); ?>

                    </p>
                    <div class="flex space-x-2">
                        <a href="<?php echo e(route('courses.show', $course)); ?>" 
                           class="inline-block bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            View Course
                        </a>
                        <form action="<?php echo e(route('bookmarks.toggle', $course)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-8">
        <?php echo e($bookmarkedCourses->links()); ?>

    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Judd\LMS\resources\views/bookmarks/index.blade.php ENDPATH**/ ?>