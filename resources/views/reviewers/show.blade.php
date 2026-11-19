@extends('layouts.app')

@section('content')
    @php
        $count = $user->reviews->count();
    @endphp

    <h2 class="font-serif text-3xl font-bold tracking-tight">{{ $user->name }}</h2>
    <p class="mb-6 mt-1 text-sm text-forest/70">{{ $count }} {{ $count === 1 ? 'review' : 'reviews' }} written</p>

    <div class="rounded-2xl border border-forest/10 bg-white px-5">
        @forelse ($user->reviews as $review)
            <div class="border-t border-forest/10 py-4 first:border-t-0">
                <p class="text-sm">
                    <a href="{{ route('eateries.show', $review->eatery) }}" class="font-semibold hover:underline">{{ $review->eatery->name }}</a>
                    · <x-rating :value="$review->rating" />
                </p>
                <p class="mt-1 text-sm">{{ $review->body }}</p>
            </div>
        @empty
            <p class="py-4 text-sm text-forest/60">No reviews yet.</p>
        @endforelse
    </div>
@endsection