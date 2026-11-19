@props(['value' => 0])

@php
    $filled = (int) round($value ?? 0);
@endphp

<span class="text-terracotta" aria-label="{{ $filled }} out of 5 stars">{{ str_repeat('★', $filled) }}<span class="text-forest/15">{{ str_repeat('★', 5 - $filled) }}</span></span>