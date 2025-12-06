<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'info', 'message']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['type' => 'info', 'message']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $colors = [
        'success' => 'bg-green-100 dark:bg-green-900 border-green-400 text-green-700 dark:text-green-300',
        'error' => 'bg-red-100 dark:bg-red-900 border-red-400 text-red-700 dark:text-red-300',
        'info' => 'bg-blue-100 dark:bg-blue-900 border-blue-400 text-blue-700 dark:text-blue-300',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900 border-yellow-400 text-yellow-700 dark:text-yellow-300',
    ];
?>

<div class="mb-4 border-l-4 p-4 <?php echo e($colors[$type]); ?>" role="alert">
    <p class="font-medium"><?php echo e($message); ?></p>
</div>

<?php /**PATH C:\Users\Judd\LMS\resources\views/components/alert.blade.php ENDPATH**/ ?>