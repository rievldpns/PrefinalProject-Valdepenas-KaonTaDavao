@extends('layouts.app')

@section('content')
    <h2 class="mb-6 font-serif text-3xl font-bold tracking-tight">Eateries</h2>

    <form method="GET" action="{{ route('eateries.index') }}"
          class="mb-8 grid grid-cols-1 gap-3 rounded-2xl bg-sand p-4 md:grid-cols-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name or specialty"
               class="h-10 rounded-lg border border-forest/20 bg-white px-3 text-sm focus:border-forest focus:outline-none focus:ring-2 focus:ring-forest/15">

        <select name="district"
                class="h-10 rounded-lg border border-forest/20 bg-white px-3 text-sm focus:border-forest focus:outline-none focus:ring-2 focus:ring-forest/15">
            <option value="">All districts</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(request('district') == $district->id)>{{ $district->name }}</option>
            @endforeach
        </select>

        <select name="feature"
                class="h-10 rounded-lg border border-forest/20 bg-white px-3 text-sm focus:border-forest focus:outline-none focus:ring-2 focus:ring-forest/15">
            <option value="">All features</option>
            @foreach ($features as $feature)
                <option value="{{ $feature->name }}" @selected(request('feature') == $feature->name)>{{ $feature->name }}</option>
            @endforeach
        </select>

        <div class="flex gap-2">
            <button type="submit" class="h-10 rounded-full bg-forest px-5 text-sm font-semibold text-lime hover:bg-forest/90">Filter</button>
            <a href="{{ route('eateries.index') }}"
               class="flex h-10 items-center rounded-full border border-forest/30 px-5 text-sm font-semibold hover:bg-white/60">Clear</a>
        </div>
    </form>

    @if ($eateries->isEmpty())
        <p class="rounded-2xl border border-dashed border-forest/30 p-10 text-center text-forest/60">No eateries match your filters.</p>
    @else
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $eateries->links() }}
        </div>
    @endif
@endsection