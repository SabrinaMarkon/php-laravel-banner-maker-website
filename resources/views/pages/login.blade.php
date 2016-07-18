@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Member Login

@stop


@section('content')

    <div class="thisistheloginpage">
        <div class="login-page">
            <div class="form">
                <form class="register-form">
                    <input type="text" placeholder="first name"/>
                    <input type="text" placeholder="last name"/>
                    <input type="password" placeholder="password"/>
                    <input type="text" placeholder="email address"/>
                    <button>create</button>
                    <p class="message">Already registered? <a href="#">Sign In</a></p>
                </form>
                <form class="login-form">
                    <input type="text" placeholder="username"/>
                    <input type="password" placeholder="password"/>
                    <button>login</button>
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