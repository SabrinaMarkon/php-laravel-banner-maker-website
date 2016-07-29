@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Forgot Your Login?

@stop

@section('content')
<div class="container">

    <div class="form-page-small">
        <div class="form">
            <form class="small-form" role="form" method="POST" action="{{ url('/password/reset') }}">
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