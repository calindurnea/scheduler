@extends('layouts.app')

@section('content')
    <h1 class="mt-4 center_title">Employees</h1>
    <div class="col-md-8 col-xs-12 col-sm-12 mt-4 mx-auto">
        <table class="table table-bordered table-hover table-responsive employees-table">
            <thead class="thead-inverse">
            <tr>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>role</th>
                <th>color</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr onclick="event.preventDefault(); document.getElementById('user-profile-form-{{$user->id}}').submit();">
                    <td class="" scope="row">{{$user->first_name}} {{$user->last_name}}
                        <form action="{{route('users.show', ['id'=>$user->id])}}" id="user-profile-form-{{$user->id}}"
                              method="get" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->roles()->pluck('role')->first()}}</td>
                    <td style="background: {{$user->hexColor()}}"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <a href="{{route('users.create')}}">
            <button class="pull-right btn btn-primary">Add employee</button>
        </a>
    </div>

@endsection