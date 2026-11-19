@extends('layouts.app')

@section('content')
    {{-- hero with the orange circle and green diamond shapes --}}
    <section class="relative mb-10 overflow-hidden rounded-3xl bg-sand px-6 py-12 sm:px-12 sm:py-16">
        <div class="pointer-events-none absolute -right-10 -top-10 h-56 w-56 rounded-full bg-terracotta"></div>
        <div class="pointer-events-none absolute -bottom-12 right-24 hidden h-40 w-40 rotate-45 bg-sage sm:block"></div>
        <div class="pointer-events-none absolute bottom-6 right-6 hidden h-16 w-16 rounded-full bg-lime sm:block"></div>

        <div class="relative max-w-xl">
            <h1 class="font-serif text-4xl font-bold leading-tight tracking-tight sm:text-5xl">Find where to eat in Davao.</h1>
            <p class="mt-4 text-forest/70">
                Carinderias and eateries around Davao City, with permits, dishes, and reviews from residents.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('eateries.index') }}" class="rounded-full bg-lime px-5 py-2.5 text-sm font-semibold text-forest hover:bg-lime/80">Browse eateries →</a>
                <a href="{{ route('districts.index') }}" class="rounded-full border border-forest/30 px-5 py-2.5 text-sm font-semibold hover:bg-forest/5">View districts</a>
            </div>
        </div>
    </section>

    <div class="mb-12 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-forest/10 bg-white p-5">
            <p class="text-sm text-forest/60">Eateries</p>
            <p class="mt-1 font-serif text-4xl font-bold">{{ $eateryCount }}</p>
        </div>
        <div class="rounded-2xl border border-forest/10 bg-white p-5">
            <p class="text-sm text-forest/60">Districts</p>
            <p class="mt-1 font-serif text-4xl font-bold">{{ $districtCount }}</p>
        </div>
        <div class="rounded-2xl border border-forest/10 bg-white p-5">
            <p class="text-sm text-forest/60">Reviews</p>
            <p class="mt-1 font-serif text-4xl font-bold">{{ $reviewCount }}</p>
        </div>
    </div>

    <h2 class="mb-4 font-serif text-2xl font-bold tracking-tight">Top Rated</h2>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($topRated as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>
@endsection