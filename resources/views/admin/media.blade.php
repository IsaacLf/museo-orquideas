@extends('layouts.madmin')

@section('title', 'Biblioteca de medios')

@section('content')
    <media 
    :media="{{ $media }}" 
    :asset="`{{ asset('storage/media') }}`"
    :action= "`{{ url('media') }}`"
    ></media>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.plupload.js') }}"></script>
    <script type="text/javascript">
        
    </script>
@endsection