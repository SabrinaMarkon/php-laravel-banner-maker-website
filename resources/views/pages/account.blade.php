@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Welcome to Sadie's!

@stop


@section('content')

    <img class="scale" src="/images/SadieStudying.jpg" border="0"><br><br><br>

    @if(Session::has('page'))
        {!! Session::get('page')->htmlcode !!}
    @endif

    <script>
        $(document).ready(function(){
            $('.sadie').hide();
        });
    </script>

@stop


@section('footer')



@stop