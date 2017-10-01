@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="table-responsive col-md-8 col-md-offset-2">
            <table class="table-hover table table-bordered users-table">
                <thead>
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
                    <tr>
                        <td class="user_profile_link_td">
                            <form action="{{route('user_show', ['id'=>$user->id])}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit"
                                        class="user_profile_link_btn">{{$user->last_name }} {{$user->first_name}}</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('user_show', ['id'=>$user->id])}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit"
                                        class="user_profile_link_btn">{{$user->email }}</button>
                            </form>
                        </td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->roles()->pluck('role')->first()}}</td>
                        <td style="background: {{$user->color}}"></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-10">
            <a href="user/create">
                <button class="pull-right btn btn-primary">Add person</button>
            </a>
        </div>
    </div>

@endsection