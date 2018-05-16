@extends('layouts.app')

@section('content')
    @include('components.backButton', ['route'=>route('users.index')])
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
    <br>
    <div class="col-md-10">
        <a href="{{route('users.edit', $user->id)}}">
            <button class="btn btn-warning">Change information</button>
        </a>
        <button class="btn btn-danger" id="delete-user">Delete employee</button>
    </div>
    @endmanagerOrAdmin
    @include('schedule.editModal')
    <div class="col-md-6 container">
        <br>

        <table data-toggle="table" class="table table-hover table-responsive-md" id="shifts-table"
               data-pagination="true"
               data-page-list="[5, 10, 20, 50, 100, 200]"
               data-click-to-select="true">
            <thead class="thead-inverse">
            <tr>
                <th data-formatter="runningFormatter" class="col-xs-1">Index</th>
                <th scope="col" data-field="start" data-sortable="true" class="col-xs-5">Start</th>
                <th scope="col" data-field="end" data-sortable="true" class="col-xs-5">End</th>
                <th scope="col" data-field="duration" data-sortable="true" class="col-xs-1">Duration (hours)</th>
                <th data-field="state" data-checkbox="true"></th>
            </tr>
            </thead>
            <input type="text" name="shiftrange" class="col-md-3 pull-right">
        </table>
        @managerOrAdmin
        <button class="btn btn-primary float-right" data-user-email="{{$user->email}}" id="mail-shifts">Mail
            selected shifts
        </button>
        @endmanagerOrAdmin
    </div>
@endsection
@section('pageScripts')
    @include('users.script')
@stop