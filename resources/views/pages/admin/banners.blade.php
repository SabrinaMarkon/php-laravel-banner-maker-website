@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    Banners

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
                    <th>#</th>
                    <th>UserID</th>
                    <th>Banner</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($banners as $banner)

                    <tr>
                        <td>{{ $banner->id }} </td>
                        <td>{{ $banner->userid }}</td>
                        <td><img src="{{ $domain }}/mybanners/{{ $banner->filename }}" target="_blank"></td>
                        <td>
                            {{ Form::open(array('route' => array('admin.banners.destroy', $banner->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-custom')) }}
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