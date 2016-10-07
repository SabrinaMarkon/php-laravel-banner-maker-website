@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Thanks for Joining!

@stop


@section('content')

    @if(Session::has('page'))
        {!! Session::get('page')->htmlcode !!}
    @endif

@stop


@section('footer')



@stop