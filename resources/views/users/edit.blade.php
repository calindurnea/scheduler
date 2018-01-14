@extends('layouts.app')

@section('content')
    @include('components.backButton', ['route'=>route("users.show", $user->id)])

    <div class="container">
        <h1>Edit information</h1>
        @include('components.errors')
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
        {!! Form::model($user, ['method' => 'PATCH', 'route'=>['users.update', $user->id]]) !!}
        <div class="form-group">
            {!! Form::label('first_name', 'First name:', ['class'=>'control-label']) !!}
            {!! Form::text('first_name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('last_name', 'Last name:', ['class'=>'control-label']) !!}
            {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email:', ['class'=>'control-label']) !!}
            {!! Form::text('email', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('phone', 'Phone:', ['class'=>'control-label']) !!}
            {!! Form::text('phone', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('role', 'Position:', ['class'=>'control-label']) !!}
            {!! Form::select('role', $role, $user->roles->pluck('id'), ['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Update information', ['class'=>'btn btn-success pull-right']) !!}
        {!! Form::close() !!}
    </div>
@endsection
