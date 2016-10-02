@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Update Account

@stop

@section('content')

    <div class="form-page-medium">


        {{ Form::open(array('route' => array('profile.update', $member->id), 'method' => 'PATCH', 'class' => 'form-horizontal form-page-small')) }}

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{!! Session::get('message') !!}</div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            {{ Form::label('', 'UserID', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10 padding5pxtop">
                {{ $member->userid }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10 padding5pxtop">
                {{ Form::text('password', old('password'), array('placeholder' => 'password')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('password_confirmation', 'Confirm', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10 padding5pxtop">
                {{ Form::text('password_confirmation', old('password'), array('placeholder' => 'confirm password')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('firstname', 'First&nbsp;Name', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10 padding5pxtop">
                {{ Form::text('firstname', $member->firstname, array('placeholder' => 'firstname')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('lastname', 'Last&nbsp;Name', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10 padding5pxtop">
                {{ Form::text('lastname', $member->lastname, array('placeholder' => 'lastname')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10 padding5pxtop">
                {{ Form::text('email', $member->email, array('placeholder' => 'email')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('', 'Sponsor', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10 padding5pxtop">
                {{ $member->referid }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12"> <br>
                {{ Form::submit('Save Profile', array('class' => 'btn btn-custom')) }}
                {{ Form::close() }}
            </div>
        </div>

    </div>

@stop


@section('footer')


@stop