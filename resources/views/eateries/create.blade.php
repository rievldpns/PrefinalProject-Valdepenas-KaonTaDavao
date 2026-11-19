@extends('layouts.app')

@section('content')
    <h2 class="mb-6 font-serif text-3xl font-bold tracking-tight">Add Eatery</h2>

    @include('eateries._form', [
        'eatery' => null,
        'action' => route('eateries.store'),
        'method' => 'POST',
        'submitLabel' => 'Add Eatery',
    ])
@endsection