@extends('layouts.app')

@section('content')
    @php
        $prices = ['budget' => '₱', 'mid' => '₱₱', 'splurge' => '₱₱₱'];
        $avg = $eatery->reviews->avg('rating');
        $count = $eatery->reviews->count();
    @endphp

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <h2 class="text-2xl font-bold">
                    {{ $eatery->name }}
                    @unless ($eatery->is_open)
                        <span class="text-xs bg-red-100 text-red-700 rounded px-2 py-1 align-middle">Closed</span>
                    @endunless
                </h2>
                <p class="text-sm mt-1">
                    <a href="{{ route('districts.show', $eatery->district) }}" class="text-orange-600 hover:underline">{{ $eatery->district->name }}</a>
                    · {{ $eatery->address }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ $prices[$eatery->price_range] ?? $eatery->price_range }}
                    @if ($eatery->specialty) · {{ $eatery->specialty }} @endif
                </p>
                <p class="text-sm mt-1">
                    @if ($count > 0)
                        <x-rating :value="$avg" /> {{ number_format($avg, 1) }} ★ ({{ $count }} {{ $count === 1 ? 'review' : 'reviews' }})
                    @else
                        No reviews yet
                    @endif
                </p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('eateries.edit', $eatery) }}" class="border rounded px-4 py-2 text-sm">Edit</a>

                <form method="POST" action="{{ route('eateries.destroy', $eatery) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white rounded px-4 py-2 text-sm">Delete</button>
                </form>
            </div>
        </div>

        <div class="flex flex-wrap gap-1 mt-3">
            @foreach ($eatery->features as $feature)
                <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                   class="text-xs bg-orange-100 text-orange-800 rounded px-2 py-1 hover:bg-orange-200">{{ $feature->name }}</a>
            @endforeach
        </div>
    </div>

    {{-- permit box --}}
    @if ($eatery->permit)
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <h3 class="font-bold mb-1">Business Permit</h3>
            <p class="text-sm">Permit no.: {{ $eatery->permit->permit_no }}</p>
            <p class="text-sm">Expires: {{ $eatery->permit->expires_on->format('M d, Y') }}</p>
            @if ($eatery->permit->expires_on->lt(today()))
                <p class="text-sm font-bold text-red-600">Permit expired</p>
            @endif
        </div>
    @endif

    {{-- dishes --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <h3 class="font-bold mb-2">Dishes</h3>
        <ul class="divide-y">
            @foreach ($eatery->dishes as $dish)
                <li class="py-2 flex justify-between text-sm">
                    <span>
                        {{ $dish->name }}
                        @if ($dish->is_bestseller)
                            <span class="text-xs bg-yellow-100 text-yellow-800 rounded px-2 py-1">Bestseller</span>
                        @endif
                    </span>
                    <span>₱{{ number_format($dish->price, 2) }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- reviews --}}
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="font-bold mb-3">Reviews</h3>

        @if ($eatery->is_open)
            {{-- review form goes here in Phase 4 --}}
        @else
            <p class="mb-4 text-gray-600">This eatery is closed. Reviews are paused.</p>
        @endif

        @forelse ($eatery->reviews as $review)
            <div class="border-t py-3">
                <div class="flex justify-between items-start">
                    <div class="text-sm">
                        <a href="{{ route('reviewers.show', $review->user) }}" class="font-bold text-orange-600 hover:underline">{{ $review->user->name }}</a>
                        · <x-rating :value="$review->rating" />
                        · <span class="text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
                    </div>

                    <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
                <p class="text-sm mt-1">{{ $review->body }}</p>
            </div>
        @empty
            <p class="text-sm text-gray-600">No reviews yet.</p>
        @endforelse
    </div>
@endsection