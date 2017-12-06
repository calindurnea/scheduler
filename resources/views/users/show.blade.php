@extends('layouts.app')

@section('content')
    @include('components.backButton')
    {{--<form action="{{route('user_edit', ['id'=>$user->id])}}" method="post">--}}
    {{--{{csrf_field()}}--}}
    {{--<input type="submit" class="btn btn-warning" value="Edit details">--}}
    {{--</form>--}}
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
    @managerOrAdmin
    <div class="dropdown">
        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Edit
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <button class="dropdown-item btn-edit" data-edit="name" type="button">Name
            </button>
            <button class="dropdown-item btn-edit" data-edit="email" type="button">Email
            </button>
            <button class="dropdown-item btn-edit" data-edit="phone" type="button">Phone
            </button>
            <button class="dropdown-item btn-edit" data-edit="color_id" type="button">Color
            </button>
            <button class="dropdown-item btn-edit" data-edit="position" type="button">Position
            </button>
            {{--<button class="dropdown-item btn-edit" data-edit="schedule" type="button">Schedule--}}
            {{--</button>--}}
        </div>
    </div>
    <button class="btn btn-danger" id="delete-user">Delete employee</button>
    @endmanagerOrAdmin

    @include('schedule.editModal')
    <ul>

        @foreach ($user->shifts as $key=>$shift)
            <li>
                {{$key}} => {{$shift}}
            </li>
        @endforeach
    </ul>
@endsection

@section('pageScripts')
    @include('users.script')
@stop