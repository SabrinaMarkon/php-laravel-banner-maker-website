@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Member Login

@stop

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-danger">{{ Session::get('message') }}</div>
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

    <div class="thisistheloginpage">
        <div class="form-page-small">
            <div class="form">

                <!-- Registration Form -->
                <form class="register-form" id="register-form" role="form" method="post" action="{{ url('/join') }}">
                    <input type="hidden" name="whichform" id="whichform" value="register">
                    <input type="hidden" name="referid" id="referid" value="{{ $referid }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" placeholder="username" name="userid" id="userid" value="{{ old('userid') }}"/>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="password" name="password" id="password"/>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="confirm password" name="password_confirmation" id="password_confirm"/>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="first name" name="firstname" id="firstname" value="{{ old('firstname') }}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="last name" name="lastname" id="lastname" value="{{ old('lastname') }}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="email address" name="email" id="email" value="{{ old('email') }}"/>
                    </div>
                    <button>create</button>
                    <p class="message">Already registered? <a href="#">Sign In</a></p>
                </form>

                <!-- Login Form -->
                <form class="login-form" role="form" id="login-form" method="post" action="{{ url('/login') }}">
                    <input type="hidden" name="whichform" id="whichform" value="login">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" placeholder="username" name="userid" id="userid"  value="{{ old('userid') }}"/>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="password" name="password" id="password"/>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label class="checkbox inline">
                                <input type="checkbox" aria-label="Remember me" id="remember">Remember me
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button>login</button>
                        <p class="forgotlogin"><a href="{{ url('forgot') }}">Forgot your login?</a></p>
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
            $('.alert ').hide();
        });
    </script>

@stop