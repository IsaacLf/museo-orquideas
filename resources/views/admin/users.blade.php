@extends('layouts.madmin')

@section('title', 'Usuarios')

@section('content')
    <users 
    :users="{{$users}}"
    :url="`{{ url('/users/create') }}`"
    :action="`{{ url('/users/create') }}`"
    :user="{{ Auth::user() }}"
    ></users>
@endsection