@props(['type' => 'info', 'message'])

@php
    $colors = [
        'success' => 'bg-green-100 dark:bg-green-900 border-green-400 text-green-700 dark:text-green-300',
        'error' => 'bg-red-100 dark:bg-red-900 border-red-400 text-red-700 dark:text-red-300',
        'info' => 'bg-blue-100 dark:bg-blue-900 border-blue-400 text-blue-700 dark:text-blue-300',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900 border-yellow-400 text-yellow-700 dark:text-yellow-300',
    ];
@endphp

<div class="mb-4 border-l-4 p-4 {{ $colors[$type] }}" role="alert">
    <p class="font-medium">{{ $message }}</p>
</div>

