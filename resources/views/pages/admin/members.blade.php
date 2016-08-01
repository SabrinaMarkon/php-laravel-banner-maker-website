@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    Members

@stop


@section('content')

    <div class="form-page-large">

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
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

        <div class="table-responsive">
            <table class="table table-hover table-condensed table-bordered text-center">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>UserID</th>
                    <th>Password</th>
                    <th>Account</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Verified</th>
                    <th>Sponsor</th>
                    <th>IP</th>
                    <th>Signup Date</th>
                    <th>Last Login</th>
                    <th>Vacation</th>
                    <th>Commission</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($members as $member)

                    <?php
                    $signupdate = new DateTime($member->signupdate);
                    $signupdate = $signupdate->format('Y-m-d');
                    $lastlogin = new DateTime($member->lastlogin);
                    $lastlogin = $lastlogin->format('Y-m-d');
                    ?>
                    <tr>
                        {{ Form::open(array('route' => array('admin.members.update', $member->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
                        <td>{{ $member->id }} </td>
                        <td>{{ $member->userid }} </td>
                        <td>{{ Form::text('password', NULL) }} </td>
                        <td>
                            <select name="admin">
                                <option value="1" @if($member->admin == 1) selected @endif>Admin</option>
                                <option value="0" @if($member->admin != 1) selected @endif>Member</option>
                             </select>
                         </td>
                        <td>{{ Form::text('firstname', $member->firstname) }} </td>
                        <td>{{ Form::text('lastname', $member->lastname) }} </td>
                        <td>{{ Form::text('email', $member->email) }} </td>
                        <td>
                            <select name="verified">
                                <option value="1" @if($member->verified == 1) selected @endif>Yes</option>
                                <option value="0" @if($member->verified != 1) selected @endif>No</option>
                            </select>
                        </td>
                        <td>{{ Form::text('referid', $member->referid) }} </td>
                        <td>{{ Form::text('ip', $member->ip) }} </td>
                        <td>{{ Form::text('signupdate', $signupdate) }} </td>
                        <td>{{ Form::text('lastlogin', $lastlogin) }} </td>
                        <td>
                            <select name="vacation">
                                <option value="1" @if($member->vacation == 1) selected @endif>Yes</option>
                                <option value="0" @if($member->vacation != 1) selected @endif>No</option>
                            </select>
                        </td>
                        <td>{{ Form::text('commission', $member->commission) }} </td>
                        <td>{{ Form::submit('Save', array('class' => 'btn btn-custom skinny')) }}</td>
                        {{ Form::close() }}
                        <td>
                            {{ Form::open(array('route' => array('admin.members.destroy', $member->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-custom skinny')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@stop


@section('footer')



@stop
