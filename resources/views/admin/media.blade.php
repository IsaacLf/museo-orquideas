@extends('layouts.madmin')

@section('title', 'Biblioteca de medios')

@section('content')
    <media 
    :media="{{ $media }}" 
    :asset="`{{ asset('storage/media') }}`"
    :action= "`{{ url('media') }}`"
    ></media>
@endsection