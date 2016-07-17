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

<a href="helpdesk" class="btn btn-danger btn-helpdesk" role="button" target="_blank">Open Helpdesk</a>

@stop


@section('footer')



@stop