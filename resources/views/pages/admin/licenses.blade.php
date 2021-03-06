@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    White Label Licenses

@stop


@section('content')

    <div class="form-page-small">
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
    </div>

    <div class="form-page-large">

        <div class="table-responsive">
            <!-- Registration Form -->
            <h2>Add License</h2>
            {{ Form::open(array('route' => array('admin.licenses.store'), 'method' => 'POST', 'class' => 'form-horizontal form-page-small')) }}
            <div class="form-group">
                {{ Form::label('userid', 'UserID', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    <select name="userid" class="form-control">
                        <option value="" disabled selected>Select UserID</option>
                        @foreach ($userids as $userid)
                            <option value="{{ $userid->userid }}">{{ $userid->userid }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
             <div class="form-group">
                {{ Form::label('licensepaiddate', 'Date&nbsp;Paid', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::text('licensepaiddate', old('licensepaiddate'), array('placeholder' => 'Date Paid')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('licensestartdate', 'Start&nbsp;Date', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::text('licensestartdate', old('licensestartdate'), array('placeholder' => 'Start Date')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('licenseenddate', 'End&nbsp;Date', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::text('licenseenddate', old('licenseenddate'), array('placeholder' => 'End Date')) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12"> <br>
                    {{ Form::submit('Add New License', array('class' => 'btn btn-custom')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <h2>All Licenses</h2>
            <table class="table table-hover table-condensed table-bordered text-center">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>UserID</th>
                    <th>Paid Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($licenses as $license)

                    <?php
                    $licensepaiddate = new DateTime($license->licensepaiddate);
                    $licensepaiddate = $licensepaiddate->format('Y-m-d');
                    $licensestartdate = new DateTime($license->licensestartdate);
                    $licensestartdate = $licensestartdate->format('Y-m-d');
                    $licenseenddate = new DateTime($license->licenseenddate);
                    $licenseenddate = $licenseenddate->format('Y-m-d');
                    $now = new DateTime();
                    $now = $now->format('Y-m-d');
                    ?>
                    <tr>
                        {{ Form::open(array('route' => array('admin.licenses.update', $license->id), 'method' => 'PATCH', 'class' => 'form-horizontal')) }}
                        @if ($now < $licenseenddate)
                            <td class="bg-success">{{ $license->id }} </td>
                        @else
                            <td class="bg-danger">{{ $license->id }} </td>
                        @endif
                        <td>
                            <select name="userid" class="form-control">
                                @foreach($userids as $userid)
                                    @if($license->userid == $userid->userid)
                                        <option value="{{ $userid->userid }}" selected="selected">{{ $userid->userid }}</option>
                                    @else
                                        <option value="{{ $userid->userid }}">{{ $userid->userid }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>{{ Form::text('licensepaiddate', $licensepaiddate) }} </td>
                        <td>{{ Form::text('licensestartdate', $licensestartdate) }} </td>
                        <td>{{ Form::text('licenseenddate', $licenseenddate) }} </td>
                        <td>{{ Form::submit('Save', array('class' => 'btn btn-custom skinny')) }}</td>
                        {{ Form::close() }}
                        <td>
                            {{ Form::open(array('route' => array('admin.licenses.destroy', $license->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) }}
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
