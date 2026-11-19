@props(['value' => 0])

@php
    $filled = (int) round($value ?? 0);
@endphp

<span class="text-yellow-500" aria-label="{{ $filled }} out of 5 stars">{{ str_repeat('★', $filled) }}<span class="text-gray-300">{{ str_repeat('★', 5 - $filled) }}</span></span>