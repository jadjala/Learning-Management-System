

<?php $__env->startSection('title', 'Edit Course'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto">
    <h1 class="text-4xl font-bold mb-8">Edit Course</h1>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <form action="<?php echo e(route('instructor.courses.update', $course)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium mb-2">Course Title</label>
                <input type="text" name="title" id="title" value="<?php echo e(old('title', $course->title)); ?>" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6">
                <label for="short_description" class="block text-sm font-medium mb-2">Short Description</label>
                <textarea name="short_description" id="short_description" rows="3" required
                          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700"><?php echo e(old('short_description', $course->short_description)); ?></textarea>
                <?php $__errorArgs = ['short_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium mb-2">Full Description</label>
                <textarea name="content" id="content" rows="6" required
                          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700"><?php echo e(old('content', $course->content)); ?></textarea>
                <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-primary hover:bg-blue-600 text-white px-6 py-2 rounded-md font-medium">
                    Update Course
                </button>
                <a href="<?php echo e(route('instructor.dashboard')); ?>" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Judd\LMS\resources\views/instructor/courses/edit.blade.php ENDPATH**/ ?>