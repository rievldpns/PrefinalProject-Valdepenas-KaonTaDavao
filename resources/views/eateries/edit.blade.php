@extends('layouts.app')

@section('content')
    <h2 class="mb-6 font-serif text-3xl font-bold tracking-tight">Edit {{ $eatery->name }}</h2>

    @include('eateries._form', [
        'action' => route('eateries.update', $eatery),
        'method' => 'PUT',
        'submitLabel' => 'Save changes',
    ])
@endsection