@extends('layouts.app')

@section('content')

    <h1 class="mt-4 center_title">Register</h1>
    <form class="col-md-3 col-xs-12 col-sm-12 mt-4 mx-auto" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('first_name') ? ' text-danger' : '' }}">
            <label for="name" class="form-control-label">First name</label>

            <input id="first_name" type="text" class="form-control" name="first_name"
                   value="{{ old('first_name') }}" required autofocus>

            @if ($errors->has('first_name'))
                <span class="text-danger">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('last_name') ? ' text-danger' : '' }}">
            <label for="last_name" class="form-control-label">Last name</label>

            <input id="last_name" type="text" class="form-control" name="last_name"
                   value="{{ old('last_name') }}" autofocus>

            @if ($errors->has('last_name'))
                <span class="text-danger">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' text-danger' : '' }}">
            <label for="email" class="form-control-label">E-Mail Address</label>

            <input id="email" type="email" class="form-control" name="email"
                   value="{{ old('email') }}" required>

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

        <div class="form-group">
            <label for="password-confirm" class="form-control-label">Confirm Password</label>

            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary mx-auto">Register</button>
        <form>
@endsection
