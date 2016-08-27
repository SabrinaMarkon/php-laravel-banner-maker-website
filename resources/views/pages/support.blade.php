@extends('layouts.main')

@section('heading')

    <script>
        $(document).ready(function() {
          $('#support-button').on('click', function( e ) {
              window.open('helpdesk');
          });
        });
    </script>

@stop


@section('pagetitle')

    Sadie's Support

@stop


@section('content')

    @if(Session::has('page'))
        {!! Session::get('page')->htmlcode !!}
        <br><a href="helpdesk" class="btn btn-custom" role="button" target="_blank">Open Helpdesk</a>
    @endif

@stop


@section('footer')



@stop