@extends('layouts.app')

@section('content')
    <h1 class="mt-4 center_title">Login</h1>
    <form class="col-md-3 col-xs-12 col-sm-12 mt-4 mx-auto" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' text-danger' : '' }}">
            <label for="email" class="form-control-label">E-Mail Address</label>

            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
                   autofocus>

            @if ($errors->has('email'))
                <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' text-danger' : '' }}">
            <label for="password" class="form-control-label">Password</label>

            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Remember Me
            </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary mx-auto">Login</button>
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </div>
    </form>
@endsection
