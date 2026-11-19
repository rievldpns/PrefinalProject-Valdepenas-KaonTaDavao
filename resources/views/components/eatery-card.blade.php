@props(['eatery'])

@php
    $prices = ['budget' => '₱', 'mid' => '₱₱', 'splurge' => '₱₱₱'];
@endphp

<div class="flex flex-col gap-3 rounded-2xl border border-forest/10 bg-white p-5 transition hover:border-forest/40">
    <div class="flex items-start justify-between gap-2">
        <h3 class="font-serif text-lg font-semibold leading-snug">
            <a href="{{ route('eateries.show', $eatery) }}" class="hover:underline">{{ $eatery->name }}</a>
        </h3>
        @unless ($eatery->is_open)
            <span class="shrink-0 rounded-full border border-terracotta/30 bg-terracotta/10 px-2.5 py-0.5 text-xs font-semibold text-terracotta">Closed</span>
        @endunless
    </div>

    <p class="text-sm text-forest/70">
        <a href="{{ route('districts.show', $eatery->district) }}" class="hover:text-forest hover:underline">{{ $eatery->district->name }}</a>
        · <span class="font-semibold text-terracotta">{{ $prices[$eatery->price_range] ?? $eatery->price_range }}</span>
    </p>

    @if ($eatery->specialty)
        <p class="text-sm">{{ $eatery->specialty }}</p>
    @endif

    <div class="flex flex-wrap gap-1.5">
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
               class="rounded-full bg-sage/20 px-2.5 py-0.5 text-xs font-medium text-forest hover:bg-sage/35">{{ $feature->name }}</a>
        @endforeach
    </div>

    <p class="mt-auto border-t border-forest/10 pt-3 text-sm text-forest/70">
        @if ($eatery->reviews_count > 0)
            <x-rating :value="$eatery->reviews_avg_rating" />
            {{ number_format($eatery->reviews_avg_rating, 1) }} ★
            ({{ $eatery->reviews_count }} {{ $eatery->reviews_count === 1 ? 'review' : 'reviews' }})
        @else
            No reviews yet
        @endif
    </p>
</div>