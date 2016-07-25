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
                <form class="register-form" role="form">
                    <input type="text" placeholder="username" name="username" id="username"/>
                    <input type="password" placeholder="password" name="password" id="password"/>
                    <input type="text" placeholder="first name" name="firstname" id="firstname"/>
                    <input type="text" placeholder="last name" name="lastname" id="lastname"/>
                    <input type="text" placeholder="email address" name="email" id="email"/>
                    <div class="g-recaptcha" data-sitekey="6LcVZSUTAAAAADj1oPlJCHUNyNAysciB8RhVJoJk"></div>
                    <button>create</button>
                    <p class="message">Already registered? <a href="#">Sign In</a></p>
                </form>
                <form class="login-form" role="form">
                    <input type="text" placeholder="username" name="username" id="username"/>
                    <input type="password" placeholder="password" name="password" id="password"/>
                    <div class="checkbox">
                        <label class="checkbox inline">
                            <input type="checkbox" aria-label="Remember me" id="rememberme">Remember me
                        </label>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LcVZSUTAAAAADj1oPlJCHUNyNAysciB8RhVJoJk"></div>
                    <button>login</button>
                    <p class="forgotlogin"><a href="forgot">Forgot your login?</a></p>
                    <p class="message">Not registered? <a href="#">Create an account</a></p>
                </form>
            </div>
        </div>
    </div>

@stop


@section('footer')

    <script>
        $('.message a').click(function(){
            $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
            $('.title').text('Join Us!');
        });
    </script>

@stop