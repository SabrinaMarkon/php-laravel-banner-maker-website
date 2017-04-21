@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    <div class="title title-home">Welcome To</div>

    <div class="title title-big">Your Site Name!</div>

@stop


@section('content')

    @if(Session::has('page'))
        {!! Session::get('page')->htmlcode !!}
    @endif

@stop


@section('footer')



@stop