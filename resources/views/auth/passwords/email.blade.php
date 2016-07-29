@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Forgot Your Login?

@stop

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="form-page-small">
        <div class="form">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="small-form" role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" name="email" placeholder="your email" value="{{ $email or old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <button>email login</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')



@stop