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
            {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label', 'autocomplete' => 'off')) }}
            <div class="col-sm-10 padding5pxtop">
                {{ Form::password('password', '') }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('password_confirmation', 'Confirm', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10 padding5pxtop">
                {{ Form::password('password_confirmation', '') }}
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
            {{ Form::label('vacation', 'Vacation', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10 padding5pxtop">
                <select name="vacation">
                    <option value="1" @if($member->vacation == 1) selected @endif>Yes</option>
                    <option value="0" @if($member->vacation != 1) selected @endif>No</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('', 'Sponsor', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10 padding5pxtop">
                @if($member->referid == '')
                    admin
                @else
                {{ $member->referid }}
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12"> <br>
                {{ Form::submit('Save Profile', array('class' => 'btn btn-custom')) }}
                {{ Form::close() }}
            </div>
        </div>

    </div>

    <script>
        $(window).load(function() {
            $("input[type=password]").val('');
        });
    </script>

@stop

@section('footer')


@stop