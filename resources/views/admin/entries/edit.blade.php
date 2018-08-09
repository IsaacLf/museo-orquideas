@extends('layouts.madmin')

@section('title', 'Editar una entrada')

@section('content')
    <div class="row">
        <div class="col md-auto">
            <h1 class="my-inline-block">Edita la entrada</h1>
        </div>
    </div>
    @include('admin.entries.form', ['entry' => $entry, 'url' => '/entries/'.$entry->id, 'method' => 'PATCH'])
@endsection