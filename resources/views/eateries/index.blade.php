@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Eateries</h2>

    <form method="GET" action="{{ route('eateries.index') }}" class="bg-white rounded-lg shadow p-4 mb-6 grid grid-cols-1 md:grid-cols-4 gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name or specialty"
               class="border rounded px-3 py-2">

        <select name="district" class="border rounded px-3 py-2">
            <option value="">All districts</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(request('district') == $district->id)>{{ $district->name }}</option>
            @endforeach
        </select>

        <select name="feature" class="border rounded px-3 py-2">
            <option value="">All features</option>
            @foreach ($features as $feature)
                <option value="{{ $feature->name }}" @selected(request('feature') == $feature->name)>{{ $feature->name }}</option>
            @endforeach
        </select>

        <div class="flex gap-2">
            <button type="submit" class="bg-orange-600 text-white rounded px-4 py-2">Filter</button>
            <a href="{{ route('eateries.index') }}" class="border rounded px-4 py-2">Clear</a>
        </div>
    </form>

    @if ($eateries->isEmpty())
        <p class="text-gray-600">No eateries match your filters.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>

        <div class="mt-6">
            {{ $eateries->links() }}
        </div>
    @endif
@endsection