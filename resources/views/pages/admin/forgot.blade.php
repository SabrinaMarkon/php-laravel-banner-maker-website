@extends('layouts.admin.login')

@section('heading')


@stop


@section('pagetitle')

    Forgot Your Login?

@stop


@section('content')

    <div class="form-page-small">

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @else
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form">
                <form class="small-form" role="form">
                    <input name='forgotemail' type="text" placeholder="your email" value="{{ old('forgotemail') }}"/>
                    <button>email login</button>
                </form>
            </div>
        </div>
    @endif

@stop


@section('footer')



@stop