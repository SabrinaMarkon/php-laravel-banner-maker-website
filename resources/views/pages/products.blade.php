@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    For Sale at Sadie's

@stop


@section('content')

    @if($page)
        {!! $page->htmlcode !!}
    @endif

    <div class="container">

        <div class="panel-group panel-products" id="accordion">

            @foreach ($products as $product)

                <div class="panel panel-default text-left">
                    <div class="panel-heading">
                        <h4 class="panel-title panel-toppadding">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $product->id }}">{{ $product->name }}</a>
                             <button class="btn btn-custom skinny pull-right btn-product">Order for ${!! $product->price !!}</button>
                            <div class="clearfix"></div>
                        </h4>
                    </div>
                    @if($product->id == 1)
                        <div class="panel-collapse collapse in" id="collapse{{ $product->id }}">
                            @else
                                <div class="panel-collapse collapse" id="collapse{{ $product->id }}">
                                    @endif
                                    <div class="panel-body">
                                        <p>{!! $product->description !!}</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                        @endforeach

                </div>

        </div>

@stop


@section('footer')



@stop