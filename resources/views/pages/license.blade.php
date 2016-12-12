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

        <div class="container-fluid">

            <img src="/images/SadieReading.jpg" border="0"><br><br><br>

            @if($page)
                {!! $page->htmlcode !!}
            @endif

                <div class="form-group row">
                    <div class="col-sm-12"> <br>
                        @if($licenseenddate)
                            <br><div class="alert alert-info">You already have an active license that is good until {{ $licenseenddate }}!</div>
                        @else
                        {{ Form::open(array('url' => 'https://www.paypal.com/cgi-bin/webscr', 'method' => 'POST', 'class' => 'form-horizontal form-page-small')) }}
                        @if ($licensepriceinterval === 'lifetime')
                            {{ Form::hidden('amount', $licenseprice) }}
                            {{ Form::hidden('cmd', '_xclick') }}
                        @else
                            {{ Form::hidden('a3', $licenseprice) }}
                            {{ Form::hidden('cmd', '_xclick-subscriptions') }}
                            {{ Form::hidden('p3', '1') }}
                            @if($licensepriceinterval === 'monthly')
                                {{ Form::hidden('t3', 'M') }}
                            @else
                                {{ Form::hidden('t3', 'Y') }}
                            @endif
                            {{ Form::hidden('src', '1') }}
                            {{ Form::hidden('sra', '1') }}
                        @endif
                        {{ Form::hidden('business', $adminpaypal) }}
                        {{ Form::hidden('item_name', $sitename . ' - White Label Banner License') }}
                        {{ Form::hidden('item_number', $licensepriceinterval) }}
                        {{ Form::hidden('no_note', '1') }}
                        {{ Form::hidden('page_style', 'PayPal') }}
                        {{ Form::hidden('no_shipping', '1') }}
                        {{ Form::hidden('return', $domain . '/thankyou') }}
                        {{ Form::hidden('cancel', $domain . '/license') }}
                        {{ Form::hidden('currency_code', 'USD') }}
                        {{ Form::hidden('lc', 'US') }}
                        {{ Form::hidden('bn', 'PP-BuyNowBF') }}
                        {{ Form::hidden('on0', 'User ID') }}
                        {{ Form::hidden('os0', Session::get('user')->userid) }}
                        {{ Form::hidden('notify_url', $domain . '/ipn') }}
                        {{ Form::submit('Buy White Label Banner License - ' . $licenseprice . ' ' . $licensepriceinterval, array('class' => 'btn btn-custom')) }}
                        {{ Form::close() }}
                        @endif
                    </div>
                </div>

            <div class="form-group row">
                <div class="col-sm-12"> <br>
                    @if($licensedlbgoldenddate)
                        {{-- Has highest level gold license already--}}
                        <br><div class="alert alert-info">You already have an active Gold license that is good until {{ $licensedlbgoldenddate }}!</div>
                    @elseif($licensedlbsilverenddate)
                        {{-- Has medium level silver license --}}
                        <br><div class="alert alert-info">You already have an active Silver license that is good until {{ $licensedlbsilverenddate }}!<br>
                        Purchase a Gold license to get an UNLIMITED number of your own programs added to the builder!</div>
                        {{--GOLD--}}
                        {{ Form::open(array('url' => 'https://www.paypal.com/cgi-bin/webscr', 'method' => 'POST', 'class' => 'form-horizontal form-page-small')) }}
                        @if ($licensedlbgoldpriceinterval === 'lifetime')
                            {{ Form::hidden('amount', $licensedlbgoldprice) }}
                            {{ Form::hidden('cmd', '_xclick') }}
                        @else
                            {{ Form::hidden('a3', $licensedlbgoldprice) }}
                            {{ Form::hidden('cmd', '_xclick-subscriptions') }}
                            {{ Form::hidden('p3', '1') }}
                            @if($licensedlbgoldpriceinterval === 'monthly')
                                {{ Form::hidden('t3', 'M') }}
                            @else
                                {{ Form::hidden('t3', 'Y') }}
                            @endif
                            {{ Form::hidden('src', '1') }}
                            {{ Form::hidden('sra', '1') }}
                        @endif
                        {{ Form::hidden('business', $adminpaypal) }}
                        {{ Form::hidden('item_name', $sitename . ' - Gold Downline Builder License') }}
                        {{ Form::hidden('item_number', $licensedlbgoldpriceinterval) }}
                        {{ Form::hidden('no_note', '1') }}
                        {{ Form::hidden('page_style', 'PayPal') }}
                        {{ Form::hidden('no_shipping', '1') }}
                        {{ Form::hidden('return', $domain . '/thankyou') }}
                        {{ Form::hidden('cancel', $domain . '/license') }}
                        {{ Form::hidden('currency_code', 'USD') }}
                        {{ Form::hidden('lc', 'US') }}
                        {{ Form::hidden('bn', 'PP-BuyNowBF') }}
                        {{ Form::hidden('on0', 'User ID') }}
                        {{ Form::hidden('os0', Session::get('user')->userid) }}
                        {{ Form::hidden('notify_url', $domain . '/ipn') }}
                        {{ Form::submit('Buy Gold Downline Builder License - ' . $licensedlbgoldprice . ' ' . $licensedlbgoldpriceinterval, array('class' => 'btn btn-custom')) }}
                        {{ Form::close() }}

                    @else
                        {{-- Has no license yet need both license order buttons --}}

                        {{--SILVER--}}
                        {{ Form::open(array('url' => 'https://www.paypal.com/cgi-bin/webscr', 'method' => 'POST', 'class' => 'form-horizontal form-page-small')) }}
                        @if ($licensedlbsilverpriceinterval === 'lifetime')
                            {{ Form::hidden('amount', $licensedlbsilverprice) }}
                            {{ Form::hidden('cmd', '_xclick') }}
                        @else
                            {{ Form::hidden('a3', $licensedlbsilverprice) }}
                            {{ Form::hidden('cmd', '_xclick-subscriptions') }}
                            {{ Form::hidden('p3', '1') }}
                            @if($licensedlbsilverpriceinterval === 'monthly')
                                {{ Form::hidden('t3', 'M') }}
                            @else
                                {{ Form::hidden('t3', 'Y') }}
                            @endif
                            {{ Form::hidden('src', '1') }}
                            {{ Form::hidden('sra', '1') }}
                        @endif
                        {{ Form::hidden('business', $adminpaypal) }}
                        {{ Form::hidden('item_name', $sitename . ' - Silver Downline Builder License') }}
                        {{ Form::hidden('item_number', $licensedlbsilverpriceinterval) }}
                        {{ Form::hidden('no_note', '1') }}
                        {{ Form::hidden('page_style', 'PayPal') }}
                        {{ Form::hidden('no_shipping', '1') }}
                        {{ Form::hidden('return', $domain . '/thankyou') }}
                        {{ Form::hidden('cancel', $domain . '/license') }}
                        {{ Form::hidden('currency_code', 'USD') }}
                        {{ Form::hidden('lc', 'US') }}
                        {{ Form::hidden('bn', 'PP-BuyNowBF') }}
                        {{ Form::hidden('on0', 'User ID') }}
                        {{ Form::hidden('os0', Session::get('user')->userid) }}
                        {{ Form::hidden('notify_url', $domain . '/ipn') }}
                        {{ Form::submit('Buy Silver Downline Builder License - ' . $licensedlbsilverprice . ' ' . $licensedlbsilverpriceinterval, array('class' => 'btn btn-custom')) }}
                        {{ Form::close() }}

                        {{--GOLD--}}
                        {{ Form::open(array('url' => 'https://www.paypal.com/cgi-bin/webscr', 'method' => 'POST', 'class' => 'form-horizontal form-page-small')) }}
                        @if ($licensedlbgoldpriceinterval === 'lifetime')
                            {{ Form::hidden('amount', $licensedlbgoldprice) }}
                            {{ Form::hidden('cmd', '_xclick') }}
                        @else
                            {{ Form::hidden('a3', $licensedlbgoldprice) }}
                            {{ Form::hidden('cmd', '_xclick-subscriptions') }}
                            {{ Form::hidden('p3', '1') }}
                            @if($licensedlbgoldpriceinterval === 'monthly')
                                {{ Form::hidden('t3', 'M') }}
                            @else
                                {{ Form::hidden('t3', 'Y') }}
                            @endif
                            {{ Form::hidden('src', '1') }}
                            {{ Form::hidden('sra', '1') }}
                        @endif
                        {{ Form::hidden('business', $adminpaypal) }}
                        {{ Form::hidden('item_name', $sitename . ' - Gold Downline Builder License') }}
                        {{ Form::hidden('item_number', $licensedlbgoldpriceinterval) }}
                        {{ Form::hidden('no_note', '1') }}
                        {{ Form::hidden('page_style', 'PayPal') }}
                        {{ Form::hidden('no_shipping', '1') }}
                        {{ Form::hidden('return', $domain . '/thankyou') }}
                        {{ Form::hidden('cancel', $domain . '/license') }}
                        {{ Form::hidden('currency_code', 'USD') }}
                        {{ Form::hidden('lc', 'US') }}
                        {{ Form::hidden('bn', 'PP-BuyNowBF') }}
                        {{ Form::hidden('on0', 'User ID') }}
                        {{ Form::hidden('os0', Session::get('user')->userid) }}
                        {{ Form::hidden('notify_url', $domain . '/ipn') }}
                        {{ Form::submit('Buy Gold Downline Builder License - ' . $licensedlbgoldprice . ' ' . $licensedlbgoldpriceinterval, array('class' => 'btn btn-custom')) }}
                        {{ Form::close() }}
                    @endif
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