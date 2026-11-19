@extends('layouts.app')

@section('content')
    <h2 class="mb-6 font-serif text-3xl font-bold tracking-tight">Districts</h2>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($districts as $district)
            <a href="{{ route('districts.show', $district) }}"
               class="rounded-2xl border border-forest/10 bg-white p-5 transition hover:border-forest/40 hover:bg-sand/50">
                <h3 class="font-serif text-xl font-semibold">{{ $district->name }}</h3>
                <p class="mt-1 text-sm text-forest/70">
                    {{ $district->eateries_count }} {{ $district->eateries_count === 1 ? 'eatery' : 'eateries' }}
                </p>
            </a>
        @endforeach
    </div>
@endsection