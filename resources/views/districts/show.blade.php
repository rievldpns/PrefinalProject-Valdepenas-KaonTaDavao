@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold">{{ $district->name }}</h2>
    <p class="text-gray-600 mb-4">
        {{ $district->reviews_count }} {{ $district->reviews_count === 1 ? 'review' : 'reviews' }} in {{ $district->name }}
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($district->eateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>
@endsection