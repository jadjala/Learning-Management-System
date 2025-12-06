

<?php $__env->startSection('title', 'Register - Simple LMS'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Register</h2>
        
        <form action="<?php echo e(route('register')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-2">Full Name</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                <?php $__errorArgs = ['name'];
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

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                <?php $__errorArgs = ['email'];
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

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
                <?php $__errorArgs = ['password'];
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

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-700">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Register as</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="role" value="student" checked class="text-primary focus:ring-primary">
                        <span class="ml-2">Student</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="role" value="instructor" class="text-primary focus:ring-primary">
                        <span class="ml-2">Instructor</span>
                    </label>
                </div>
                <?php $__errorArgs = ['role'];
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

            <button type="submit" class="w-full bg-primary hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md">
                Register
            </button>
        </form>

        <p class="mt-4 text-center text-sm">
            Already have an account? 
            <a href="<?php echo e(route('login')); ?>" class="text-primary hover:underline">Login here</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Judd\LMS\resources\views/auth/register.blade.php ENDPATH**/ ?>