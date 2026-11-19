@props(['eatery'])

@php
    $prices = ['budget' => '₱', 'mid' => '₱₱', 'splurge' => '₱₱₱'];
@endphp

<div class="bg-white rounded-lg shadow p-4 flex flex-col gap-2">
    <div class="flex items-start justify-between gap-2">
        <h3 class="text-lg font-bold">
            <a href="{{ route('eateries.show', $eatery) }}" class="hover:text-orange-600">{{ $eatery->name }}</a>
        </h3>
        @unless ($eatery->is_open)
            <span class="text-xs bg-red-100 text-red-700 rounded px-2 py-1">Closed</span>
        @endunless
    </div>

    <p class="text-sm">
        <a href="{{ route('districts.show', $eatery->district) }}" class="text-orange-600 hover:underline">{{ $eatery->district->name }}</a>
        · {{ $prices[$eatery->price_range] ?? $eatery->price_range }}
    </p>

    @if ($eatery->specialty)
        <p class="text-sm text-gray-600">{{ $eatery->specialty }}</p>
    @endif

    <div class="flex flex-wrap gap-1">
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
               class="text-xs bg-orange-100 text-orange-800 rounded px-2 py-1 hover:bg-orange-200">{{ $feature->name }}</a>
        @endforeach
    </div>

    <p class="text-sm mt-auto">
        @if ($eatery->reviews_count > 0)
            <x-rating :value="$eatery->reviews_avg_rating" />
            {{ number_format($eatery->reviews_avg_rating, 1) }} ★
            ({{ $eatery->reviews_count }} {{ $eatery->reviews_count === 1 ? 'review' : 'reviews' }})
        @else
            No reviews yet
        @endif
    </p>
</div>