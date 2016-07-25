@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    Members

@stop


@section('content')

    <div class="form-page-large">

            @foreach ($members as $member)

                <form class="form-horizontal" role="form">

                    <div class="form-group">
                        <div class="table">
                            <div class="row">
                                <div class="col-sm-1">{{ $member->userid }}</div>
                                <div class="col-sm-1"><input type="text" class="form-control" name="passwordp" id="passwordp" placeholder="password" value="{{ $member->password }}"></div>
                                <div class="col-sm-1"><input type="text" class="form-control" name="firstnamep" id="firstnamep" placeholder="first name" value="{{ $member->firstname }}"></div>
                                <div class="col-sm-1"><input type="text" class="form-control" name="lastnamep" id="lastnamep" placeholder="last name" value="{{ $member->password }}"></div>
                                <div class="col-sm-1"><input type="text" class="form-control" name="emailp" id="emailp" placeholder="email" value="{{ $member->email }}"></div>
                                <div class="col-sm-1"><input type="text" class="form-control" name="verifiedp" id="verifiedp" placeholder="verified" value="{{ $member->verified }}"></div>
                                <div class="col-sm-1"><input type="text" class="form-control" name="referidp" id="referidp" placeholder="sponsor userid" value="{{ $member->referid }}"></div>
                                <div class="col-sm-1">{{ $member->ip }}</div>
                                <div class="col-sm-1">{{ $member->signupdate }}</div>
                                <div class="col-sm-1">{{ $member->lastlogin }}</div>
                                <div class="col-sm-1"><input type="text" class="form-control" name="vacationp" id="vacationp" placeholder="vacation mode" value="{{ $member->vacation }}"></div>
                                <div class="col-sm-1"><input type="text" class="form-control" name="commissionp" id="commissionp" placeholder="commissions owing" value="{{ $member->commission }}"></div>
                                <input type="hidden" class="form-control" name="idp" id="idp" value="{{ $member->id }}">
                            </div>
                        </div>
                    </div>

                </form>
            @endforeach

    </div>

@stop


@section('footer')



@stop