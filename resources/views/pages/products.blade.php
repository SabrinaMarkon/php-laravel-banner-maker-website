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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $product->id }}" class="productname">{{ $product->name }}</a>
                            {{ Form::open(array('url' => 'https://www.paypal.com/cgi-bin/webscr', 'method' => 'POST', 'class' => 'form-horizontal')) }}
                            {{ Form::hidden('amount', $product->price) }}
                            {{ Form::hidden('cmd', '_xclick') }}
                            {{ Form::hidden('business', $adminpaypal) }}
                            {{ Form::hidden('item_name', $sitename . ' - ' . $product->name) }}
                            {{ Form::hidden('page_style', 'PayPal') }}
                            {{ Form::hidden('no_shipping', '1') }}
                            {{ Form::hidden('return', $domain . '/thankyou') }}
                            {{ Form::hidden('cancel', $domain . '/products') }}
                            {{ Form::hidden('currency_code', 'USD') }}
                            {{ Form::hidden('lc', 'US') }}
                            {{ Form::hidden('bn', 'PP-BuyNowBF') }}
                            {{ Form::hidden('on0', 'User ID') }}
                            {{ Form::hidden('os0', Session::get('user')->userid) }}
                            {{ Form::hidden('on1', 'Product ID') }}
                            {{ Form::hidden('os1', $product->id) }}
                            {{ Form::hidden('notify_url', $domain . '/ipn') }}
                            {{ Form::submit('Order for $' . $product->price, array('class' => 'btn btn-custom skinny pull-right btn-product')) }}
                            {{ Form::close() }}
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