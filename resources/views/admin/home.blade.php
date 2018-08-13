@extends('layouts.madmin')

@if ($user->profile == 'administrator')
    @section('title', 'Administrador')
@else
    @section('title', 'Editor')
@endif

@section('content')

    <h1>Inicio</h1>
    <div class="row justify-content-center mb-0">
        <div class="col md-auto">
            <div class="card bg-dark">
                <h6 class="card-header"><b>Dé un vistazo</b></h6>
                <div class="card-body">
                    <p class="card-text">
                        <i class="fas fa-thumbtack"></i>
                        <a href="{{ url('edit') }}">{{ App\Entry::count() }} entrada(s)</a>
                    </p>
                    @if(Auth::user()->profile == 'administrator')
                    <p class="card-text">
                        <i class="fas fa-user"></i>
                        <a href="{{ url('/users') }}">{{ App\User::count() }} usuario(s)</a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- <hr> -->
    <div class="row justify-content-center">
        <div class="col md-auto">
            <div class="card bg-dark">
                <h6 class="card-header"><b>Actividad</b></h6>
                <div class="card-body">
                    <h6 class="card-title"><b>Entradas recientes</b></h6>
                    <p class="card-text">
                        <ul class="mylist components">
                        @foreach($entries as $entry)
                            @if($entry->created_at != '' || $entry->updated_at != '')
                                @if(\Carbon\Carbon::parse('today')->diffinDays(\Carbon\Carbon::parse($entry->created_at)) <= 7 || \Carbon\Carbon::parse('today')->diffinDays(\Carbon\Carbon::parse($entry->updated_at)) <= 7)
                                <li>
                                    <span class="text-muted">{{ $entry->updated_at }}</span>
                                    <a href="{{ url('entries/'.$entry->id.'/edit') }}">{{ $entry->title }}</a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                        </ul>
                    </p> 
                </div>
            </div>
        </div>
    </div>

@endsection
