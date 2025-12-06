

<?php $__env->startSection('title', $course->title); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-6">
    <div class="flex justify-between items-start mb-4">
        <div class="flex-1">
            <h1 class="text-4xl font-bold mb-2"><?php echo e($course->title); ?></h1>
            <p class="text-gray-600 dark:text-gray-400">
                Instructor: <span class="font-medium"><?php echo e($course->instructor->name); ?></span>
            </p>
        </div>

        <?php if(auth()->guard()->check()): ?>
            <?php if(Auth::user()->isStudent()): ?>
                <?php if($isEnrolled): ?>
                    <form action="<?php echo e(route('student.courses.unenroll', $course)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md font-medium">
                            Unenroll
                        </button>
                    </form>
                <?php else: ?>
                    <form action="<?php echo e(route('student.courses.enroll', $course)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-md font-medium">
                            Enroll Now
                        </button>
                    </form>
                <?php endif; ?>
            <?php elseif(Auth::user()->id === $course->user_id): ?>
                <div class="flex space-x-2">
                    <a href="<?php echo e(route('instructor.courses.edit', $course)); ?>" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md font-medium">
                        Edit Course
                    </a>
                    <a href="<?php echo e(route('instructor.lessons.create', $course)); ?>" 
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md font-medium">
                        Add Lesson
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="prose dark:prose-invert max-w-none">
        <h3 class="text-xl font-semibold mb-2">About this course</h3>
        <p class="text-gray-700 dark:text-gray-300"><?php echo e($course->short_description); ?></p>
        
        <div class="mt-4">
            <h3 class="text-xl font-semibold mb-2">Course Description</h3>
            <p class="text-gray-700 dark:text-gray-300"><?php echo e($course->content); ?></p>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Course Lessons (<?php echo e($course->lessons->count()); ?>)</h2>

    <?php if($course->lessons->isEmpty()): ?>
        <p class="text-gray-500 dark:text-gray-400">No lessons added yet.</p>
    <?php else: ?>
        <div class="space-y-4">
            <?php $__currentLoopData = $course->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:border-primary transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold mb-2"><?php echo e($lesson->title); ?></h3>
                            <p class="text-gray-700 dark:text-gray-300"><?php echo e(Str::limit($lesson->content, 200)); ?></p>
                        </div>

                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->id === $course->user_id): ?>
                                <div class="flex space-x-2 ml-4">
                                    <a href="<?php echo e(route('instructor.lessons.edit', [$course, $lesson])); ?>" 
                                       class="text-yellow-500 hover:text-yellow-600 font-medium">
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('instructor.lessons.destroy', [$course, $lesson])); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-500 hover:text-red-600 font-medium"
                                                onclick="return confirm('Are you sure you want to delete this lesson?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Judd\LMS\resources\views/courses/show.blade.php ENDPATH**/ ?>