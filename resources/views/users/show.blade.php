@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.backButton')
        <form action="{{route('user_edit', ['id'=>$user->id])}}" method="post">
            {{csrf_field()}}
            <input type="submit" class="btn btn-warning" value="Edit details">
        </form>
        <div class="user_details_block">
            <h3><strong>{{$user->first_name}} {{$user->last_name}}</strong> <span
                        class="user_span_position">{{$user->roles()->pluck('role')->first()}}</span></h3>

            <h5>
                <div>
                    <i class="fa fa-envelope"
                       aria-hidden="true"></i> @include('users.checkEmptyField', ['value' => $user->email]) |
                </div>
                <div>
                    <i class="fa fa-phone-square"
                       aria-hidden="true"></i> @include('users.checkEmptyField', ['value' => $user->phone])
                </div>
            </h5>
        </div>

        <div class="user_color_block" style="background: {{$user->hexColor()}}">

        </div>
        @foreach ($user->shifts as $key=>$shift)
            <li>
                {{$key}} => {{$shift}}
            </li>
        @endforeach
    </div>
@endsection