@extends('layouts.madmin')

@section('title', 'Añadir nueva entrada')

@section('content')
    <div class="row">
        <div class="col md-auto">
            <h1 class="my-inline-block">Añadir nueva entrada</h1>
        </div>
    </div>
    @include('admin.entries.form', ['entry' => $entry, 'url' => '/entries', 'method' => 'POST'])
@endsection