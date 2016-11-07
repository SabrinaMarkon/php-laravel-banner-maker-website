@extends('layouts.admin.login')

@section('heading')


@stop


@section('pagetitle')

    Admin Login

@stop


@section('content')


    <div class="form-page-small">
        <div class="form">

            @if (Session::has('message'))
                @if (Session::get('message' ) == 'resetsuccess')
                    <div class="alert alert-success">Your password was updated successfully!</div>
                @else
                    <div class="alert alert-danger">{{ Session::get('message') }}</div>
                @endif
            @endif

            <!-- Login Form -->
            <form class="login-form" role="form" id="login-form" method="post" action="{{ url('admin') }}">
                <input type="hidden" name="whichform" id="whichform" value="login">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('userid') ? ' has-error' : '' }}">
                    <input type="text" placeholder="username" name="userid" id="userid"  value="{{ old('userid') }}"/>
                    @if ($errors->has('userid'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('userid') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" placeholder="password" name="password" id="password"/>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label class="checkbox inline">
                            <input type="checkbox" aria-label="Remember me" id="remember">Remember me
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LcVZSUTAAAAADj1oPlJCHUNyNAysciB8RhVJoJk"></div>
                    <button>login</button>
                    <p class="forgotlogin"><a href="{{ url('admin/forgot') }}">Forgot your login?</a></p>
                </div>
            </form>
        </div>
    </div>

@stop


@section('footer')



@stop