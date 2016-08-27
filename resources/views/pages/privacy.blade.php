@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Your Privacy

@stop


@section('content')

    @if(Session::has('page'))
        {!! Session::get('page')->htmlcode !!}
    @endif

@stop


@section('footer')



@stop