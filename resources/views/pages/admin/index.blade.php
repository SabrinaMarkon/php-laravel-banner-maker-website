@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    Admin Area

@stop


@section('content')

    Show Login if Not Logged In

        <div class="form-page-small">
            <div class="form">
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
                    <p class="forgotlogin"><a href="admin/forgot">Forgot your login?</a></p>
                </form>
            </div>
        </div>

@stop


@section('footer')



@stop