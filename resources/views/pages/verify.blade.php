@extends('layouts.main')

@section('heading')

@stop

@section('pagetitle')

    Email Verification

@stop

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-danger">{!! Session::get('message') !!}</div>
    @else
        @if(Session::has('page'))
            {!! Session::get('page')->htmlcode !!}
        @endif
    @endif

@stop

@section('footer')

@stop
