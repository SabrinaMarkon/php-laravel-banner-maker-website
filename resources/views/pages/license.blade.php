@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Sadie's Special White Label License

@stop


@section('content')

    <div class="form-page-medium">

        <div class="table-responsive">

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

@stop


@section('footer')



@stop