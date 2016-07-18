@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    Members

@stop


@section('content')

    {{--}} include the member file that gets all members from the db. --}}
    @include('members.index')

@stop


@section('footer')



@stop