@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $eateryCount }}</p>
            <p class="text-sm text-gray-600">Eateries</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $districtCount }}</p>
            <p class="text-sm text-gray-600">Districts</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $reviewCount }}</p>
            <p class="text-sm text-gray-600">Reviews</p>
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-4">Top Rated</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($topRated as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>
@endsection