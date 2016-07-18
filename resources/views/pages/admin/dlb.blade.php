@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    Downline Builder

@stop


@section('content')

    {{--}} include the downline builder file that gets all builders from the db. --}}
    @include('builders.index')

@stop


@section('footer')



@stop