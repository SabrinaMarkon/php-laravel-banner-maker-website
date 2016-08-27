@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Terms of Use

@stop


@section('content')

    @if(Session::has('page'))
        {!! Session::get('page')->htmlcode !!}
    @endif

@stop


@section('footer')



@stop