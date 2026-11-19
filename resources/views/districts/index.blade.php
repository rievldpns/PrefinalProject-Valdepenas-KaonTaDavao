@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Districts</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($districts as $district)
            <a href="{{ route('districts.show', $district) }}" class="bg-white rounded-lg shadow p-4 hover:bg-orange-100">
                <h3 class="text-lg font-bold">{{ $district->name }}</h3>
                <p class="text-sm text-gray-600">
                    {{ $district->eateries_count }} {{ $district->eateries_count === 1 ? 'eatery' : 'eateries' }}
                </p>
            </a>
        @endforeach
    </div>
@endsection