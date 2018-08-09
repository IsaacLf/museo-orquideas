@extends('layouts.madmin')

@section('title', 'Entradas')

@section('content')
    <div class="row">
        <div class="col-md-auto">
            <h1 class="my-inline-block">Entradas</h1>
        </div>
        <div class="col-md-auto">
            <a href="{{ url('/entries/create') }}" class="btn btn-primary">Añadir nueva</a>
        </div>
    </div>
    <entries 
    :user="{{ Auth::user() }}" 
    :entries="{{ $entries }}" 
    :entry="{{ json_encode(App\Entry::count()) }}" 
    :mine="{{ json_encode($mine_count) }}"
    :url="{{ json_encode(url('/entries/')) }}"
    >
    </entries>
@endsection