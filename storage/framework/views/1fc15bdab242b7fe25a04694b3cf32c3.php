

<?php $__env->startSection('title', $course->title); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
        <?php if($course->thumbnail): ?>
            <img src="<?php echo e(asset('storage/' . $course->thumbnail)); ?>" 
                 alt="<?php echo e($course->title); ?>" 
                 class="w-full h-64 object-cover">
        <?php else: ?>
            <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                <span class="text-gray-400 text-6xl">📚</span>
            </div>
        <?php endif; ?>

        <div class="p-8">
            <h1 class="text-4xl font-bold mb-4"><?php echo e($course->title); ?></h1>
            <p class="text-gray-600 dark:text-gray-400 mb-4"><?php echo e($course->short_description); ?></p>
            
            <div class="flex items-center space-x-4 mb-6">
                <span class="text-sm text-gray-500">
                    👨‍🏫 Instructor: <strong><?php echo e($course->instructor->name); ?></strong>
                </span>
                <span class="text-sm text-gray-500">
                    📚 <?php echo e($course->lessons->count()); ?> lessons
                </span>
                <span class="text-sm text-gray-500">
                    👥 <?php echo e($course->enrollments->count()); ?> students
                </span>
            </div>

            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->isStudent()): ?>
                    <div class="flex space-x-4">
                        
                        <?php if($isEnrolled): ?>
                            <form action="<?php echo e(route('enrollments.destroy', $course->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md font-medium">
                                    Unenroll from Course
                                </button>
                            </form>
                        <?php else: ?>
                            <form action="<?php echo e(route('enrollments.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
                                <button type="submit" class="bg-primary hover:bg-blue-600 text-white px-6 py-2 rounded-md font-medium">
                                    Enroll in Course
                                </button>
                            </form>
                        <?php endif; ?>

                        
                        <?php if($isBookmarked): ?>
                            <form action="<?php echo e(route('bookmarks.destroy', $course->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-md font-medium flex items-center">
                                    <span class="mr-2">⭐</span>
                                    Remove Bookmark
                                </button>
                            </form>
                        <?php else: ?>
                            <form action="<?php echo e(route('bookmarks.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
                                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md font-medium flex items-center">
                                    <span class="mr-2">☆</span>
                                    Bookmark Course
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <p class="text-gray-500">
                    <a href="<?php echo e(route('login')); ?>" class="text-primary hover:underline">Login</a> or 
                    <a href="<?php echo e(route('register')); ?>" class="text-primary hover:underline">Register</a> to enroll in this course
                </p>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold mb-4">About This Course</h2>
        <div class="prose dark:prose-invert max-w-none">
            <?php echo nl2br(e($course->content)); ?>

        </div>
    </div>

    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6">Course Lessons</h2>
        
        <?php if($course->lessons->isEmpty()): ?>
            <p class="text-gray-500">No lessons available yet.</p>
        <?php else: ?>
            <div class="space-y-4">
                <?php $__currentLoopData = $course->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-2">
                                    <span class="text-gray-400 mr-2"><?php echo e($index + 1); ?>.</span>
                                    <?php echo e($lesson->title); ?>

                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                    <?php echo e(Str::limit($lesson->content, 150)); ?>

                                </p>
                            </div>
                            
                            <?php if($isEnrolled): ?>
                                <a href="#" class="ml-4 text-primary hover:underline text-sm whitespace-nowrap">
                                    View Lesson →
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Judd\LMS\resources\views/courses/show.blade.php ENDPATH**/ ?>