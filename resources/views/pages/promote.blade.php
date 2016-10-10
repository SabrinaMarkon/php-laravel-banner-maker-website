@extends('layouts.main')

@section('heading')

@stop


@section('pagetitle')

    Promote Sadie's

@stop


@section('content')

    @if($page)
        {!! $page->htmlcode !!}
    @endif

    <div class="container">

            <div>

                <div class="panel panel-default text-left">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Your Affiliate URL
                        </h4>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2"><strong>Your URL: </strong></div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $domain }}/{{ Session::get('user')->userid }}">
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default text-left">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Number of Referrals: {{ count($referrals) }}
                        </h4>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2"><strong>Your Earnings: </strong></div>
                            <div class="col-sm-8">${{ Session::get('user')->commission }}</div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2"><strong>Your Referrals: </strong></div>
                            <div class="col-sm-8">
                                @if (count($referrals) > 0)
                                    @foreach($referrals as $referral)
                                        {{ $referral->userid }}<br>
                                    @endforeach
                                @else
                                    No referrals yet
                                @endif
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                    </div>
                </div>

                @foreach ($promotes as $promote)

                    @if ($promote->type == 'banner')
                        <div class="panel panel-default text-left">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    {{ $promote->name }}
                                </h4>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-2"><strong>Banner URL: </strong></div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ $promote->p_image }}">
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-2"><strong>Image: </strong></div>
                                    <div class="col-sm-8">
                                        <img src="{{ $promote->p_image }}" class="border1px">
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="panel panel-default text-left">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    {{ $promote->name }}
                                </h4>
                            </div>
                            <div class="panel-body text-center">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2"><strong>Email Subject: </strong></div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{ $promote->p_subject }}">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2"><strong>Email Message: </strong></div>
                                        <div class="col-sm-8">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="active"><a data-target="#html{{ $promote->id }}" data-toggle="tab">HTML</a></li>
                                                <li><a data-target="#source{{ $promote->id }}" data-toggle="tab">Source Code</a></li>
                                            </ul>
                                            <div class="tab-content text-left">
                                                <div class="tab-pane active" id="html{{ $promote->id }}">{!! $promote->p_message !!}</div>
                                                <div class="tab-pane" id="source{{ $promote->id }}">{{ $promote->p_message }}</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endif

                 @endforeach

            </div>

        </div>

@stop


@section('footer')



@stop