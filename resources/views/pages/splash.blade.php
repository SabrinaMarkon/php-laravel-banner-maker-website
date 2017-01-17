@extends('layouts.splash')

@section('content')

    @if(Session::has('page'))
        {!! Session::get('page') !!}
    @endif

@stop

