@extends('layouts.app')

@section('content')
    <h2 class="font-serif text-3xl font-bold tracking-tight">{{ $district->name }}</h2>
    <p class="mb-6 mt-1 text-sm text-forest/70">
        {{ $district->reviews_count }} {{ $district->reviews_count === 1 ? 'review' : 'reviews' }} in {{ $district->name }}
    </p>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($district->eateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>
@endsection