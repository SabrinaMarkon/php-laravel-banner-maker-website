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
        <br>

        <div class="helpdeskbox">
            <a href="helpdesk" class="btn btn-custom" role="button" target="_blank">Open Helpdesk</a><img src="/images/SadieOnThePhone.jpg" border="0">
        </div>

        <script>
            $(document).ready(function(){
                $('.sadie').hide();
            });
        </script>

    @endif

@stop


@section('footer')



@stop