@extends('layouts.app')

@section('content')
    @php
        $count = $user->reviews->count();
    @endphp

    <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
    <p class="text-gray-600 mb-4">{{ $count }} {{ $count === 1 ? 'review' : 'reviews' }} written</p>

    <div class="bg-white rounded-lg shadow p-4">
        @forelse ($user->reviews as $review)
            <div class="border-t first:border-t-0 py-3">
                <p class="text-sm">
                    <a href="{{ route('eateries.show', $review->eatery) }}" class="font-bold text-orange-600 hover:underline">{{ $review->eatery->name }}</a>
                    · <x-rating :value="$review->rating" />
                </p>
                <p class="text-sm mt-1">{{ $review->body }}</p>
            </div>
        @empty
            <p class="text-sm text-gray-600">No reviews yet.</p>
        @endforelse
    </div>
@endsection