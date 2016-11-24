@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Sadie's Special White Label License

@stop


@section('content')

    <div class="form-page-medium">

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            
        <div class="table-responsive">

            <img src="/images/SadieReading.jpg" border="0"><br><br><br>

            @if($page)
                {!! $page->htmlcode !!}
            @endif

                <div class="form-group">
                    <div class="col-sm-12"> <br>
                        {{ Form::open(array('url' => 'http://paypal.com', 'method' => 'POST', 'class' => 'form-horizontal form-page-small')) }}
                        {{ Form::submit('Buy License', array('class' => 'btn btn-custom')) }}
                        {{ Form::close() }}
                    </div>
                </div>

        </div>

    </div>

    <script>
        $(document).ready(function(){
            $('.sadie').hide();
        });
    </script>

@stop


@section('footer')



@stop