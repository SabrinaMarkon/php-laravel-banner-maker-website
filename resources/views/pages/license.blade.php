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
                        {{ Form::open(array('url' => 'https://www.paypal.com/cgi-bin/webscr', 'method' => 'POST', 'class' => 'form-horizontal form-page-small')) }}
                        {{ Form::hidden('amount', $licenseprice) }}
                        {{ Form::hidden('cmd', '_xclick') }}
                        {{ Form::hidden('business', $adminpaypal) }}
                        {{ Form::hidden('item_name', $sitename . ' White Label Image License') }}
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