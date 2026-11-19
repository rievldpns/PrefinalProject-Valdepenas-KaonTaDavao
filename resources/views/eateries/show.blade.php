@extends('layouts.app')

@section('content')
    @php
        $prices = ['budget' => '₱', 'mid' => '₱₱', 'splurge' => '₱₱₱'];
        $avg = $eatery->reviews->avg('rating');
        $count = $eatery->reviews->count();
    @endphp

    {{-- header card --}}
    <div class="mb-6 rounded-2xl border border-forest/10 bg-white p-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h2 class="font-serif text-3xl font-bold tracking-tight">
                    {{ $eatery->name }}
                    @unless ($eatery->is_open)
                        <span class="ml-2 rounded-full border border-terracotta/30 bg-terracotta/10 px-2.5 py-0.5 align-middle font-sans text-xs font-semibold text-terracotta">Closed</span>
                    @endunless
                </h2>
                <p class="mt-1 text-sm text-forest/70">
                    <a href="{{ route('districts.show', $eatery->district) }}" class="hover:text-forest hover:underline">{{ $eatery->district->name }}</a>
                    · {{ $eatery->address }}
                </p>
                <p class="mt-1 text-sm">
                    <span class="font-semibold text-terracotta">{{ $prices[$eatery->price_range] ?? $eatery->price_range }}</span>
                    @if ($eatery->specialty) · {{ $eatery->specialty }} @endif
                </p>
                <p class="mt-2 text-sm text-forest/70">
                    @if ($count > 0)
                        <x-rating :value="$avg" /> {{ number_format($avg, 1) }} ★ ({{ $count }} {{ $count === 1 ? 'review' : 'reviews' }})
                    @else
                        No reviews yet
                    @endif
                </p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('eateries.edit', $eatery) }}"
                   class="rounded-full border border-forest/30 px-5 py-2 text-sm font-semibold hover:bg-forest/5">Edit</a>

                <form method="POST" action="{{ route('eateries.destroy', $eatery) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="rounded-full border border-red-300 px-5 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">Delete</button>
                </form>
            </div>
        </div>

        <div class="mt-4 flex flex-wrap gap-1.5">
            @foreach ($eatery->features as $feature)
                <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                   class="rounded-full bg-sage/20 px-2.5 py-0.5 text-xs font-medium text-forest hover:bg-sage/35">{{ $feature->name }}</a>
            @endforeach
        </div>
    </div>

    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
        {{-- permit box --}}
        <div class="rounded-2xl bg-sand p-5">
            <h3 class="mb-3 font-serif text-lg font-semibold">Business Permit</h3>
            @if ($eatery->permit)
                <p class="text-sm text-forest/60">Permit no.</p>
                <p class="font-mono text-sm font-medium">{{ $eatery->permit->permit_no }}</p>
                <p class="mt-3 text-sm text-forest/60">Expires</p>
                <p class="text-sm">{{ $eatery->permit->expires_on->format('M d, Y') }}</p>
                @if ($eatery->permit->expires_on->lt(today()))
                    <p class="mt-3 text-sm font-bold text-red-600">Permit expired</p>
                @endif
            @endif
        </div>

        {{-- dishes --}}
        <div class="rounded-2xl border border-forest/10 bg-white p-5">
            <h3 class="mb-3 font-serif text-lg font-semibold">Dishes</h3>
            <ul class="divide-y divide-forest/10">
                @foreach ($eatery->dishes as $dish)
                    <li class="flex items-center justify-between gap-3 py-2 text-sm">
                        <span>
                            {{ $dish->name }}
                            @if ($dish->is_bestseller)
                                <span class="ml-1 rounded-full bg-lime px-2 py-0.5 text-xs font-semibold text-forest">Bestseller</span>
                            @endif
                        </span>
                        <span class="font-semibold text-terracotta">₱{{ number_format($dish->price, 2) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- reviews --}}
    <div class="rounded-2xl border border-forest/10 bg-white p-5">
        <h3 class="mb-4 font-serif text-lg font-semibold">Reviews</h3>

        @if ($eatery->is_open)
            {{-- review form goes here in Phase 4 --}}
        @else
            <p class="mb-4 rounded-xl bg-sand px-4 py-3 text-sm">This eatery is closed. Reviews are paused.</p>
        @endif

        @forelse ($eatery->reviews as $review)
            <div class="border-t border-forest/10 py-4">
                <div class="flex items-start justify-between gap-3">
                    <div class="text-sm">
                        <a href="{{ route('reviewers.show', $review->user) }}" class="font-semibold hover:underline">{{ $review->user->name }}</a>
                        · <x-rating :value="$review->rating" />
                        · <span class="text-forest/60">{{ $review->created_at->format('M d, Y') }}</span>
                    </div>

                    <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-forest/40 hover:text-red-600">Delete</button>
                    </form>
                </div>
                <p class="mt-1 text-sm">{{ $review->body }}</p>
            </div>
        @empty
            <p class="text-sm text-forest/60">No reviews yet.</p>
        @endforelse
    </div>
@endsection