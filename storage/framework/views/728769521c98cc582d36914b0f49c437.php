

<?php $__env->startSection('title', 'Login - Simple LMS'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Login</h2>
        
        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
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
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="ml-2 text-sm">Remember me</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md">
                Login
            </button>
        </form>

        <p class="mt-4 text-center text-sm">
            Don't have an account? 
            <a href="<?php echo e(route('register')); ?>" class="text-primary hover:underline">Register here</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Judd\LMS\resources\views/auth/login.blade.php ENDPATH**/ ?>