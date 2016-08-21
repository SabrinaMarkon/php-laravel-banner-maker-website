@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    @if(!Session::has('page'))
        404 Page Not Found
    @endif

@stop


@section('content')

    @if(Session::has('page'))
        {!! Session::get('page')->htmlcode !!}
    @else
        <div class="text-center"><a href="/">Main Page</a></div>
    @endif

@stop


@section('footer')



@stop