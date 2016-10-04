@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Member Login

@stop

@section('content')

    <div class="thisistheloginpage">
        <div class="form-page-small">
            <div class="form">

                <!-- Registration Form -->
                <form class="register-form" id="register-form" role="form" method="post" action="{{ url('/register') }}">
                    <input type="hidden" name="whichform" id="whichform" value="register">
                    <input type="hidden" name="referid" id="referid" value="{{ $referid }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('userid') ? ' has-error' : '' }}">
                        <input type="text" placeholder="username" name="userid" id="userid" value="{{ old('userid') }}"/>
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
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input type="password" placeholder="confirm password" name="password_confirmation" id="password_confirm"/>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <input type="text" placeholder="first name" name="firstname" id="firstname" value="{{ old('firstname') }}"/>
                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                        @endif
                     </div>
                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                     <input type="text" placeholder="last name" name="lastname" id="lastname" value="{{ old('lastname') }}"/>
                        @if ($errors->has('lastname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="text" placeholder="email address" name="email" id="email" value="{{ old('email') }}"/>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LcVZSUTAAAAADj1oPlJCHUNyNAysciB8RhVJoJk"></div>
                    <button>create</button>
                    <p class="message">Already registered? <a href="#">Sign In</a></p>
                </form>

                <!-- Login Form -->
                <form class="login-form" role="form" id="login-form" method="post" action="{{ url('/login') }}">
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
                        <p class="forgotlogin"><a href="{{ url('/password/reset') }}">Forgot your login?</a></p>
                        <p class="message">Not registered? <a href="#">Create an account</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop


@section('footer')

    <script>
        $('.message a').click(function(){
            $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
           if ($('.title').text() == 'Join Us!' ? $('.title').text('Member Login') : $('.title').text('Join Us!'));
        });
    </script>

@stop