@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mt-4 center_title">Create schedule</h1>
        <div class="create_user_form_container">
            <form class="form-horizontal">
                {{ csrf_field() }}

                @component('components.daySchedule',['day'=>'monday'])@endcomponent
                @component('components.daySchedule',['day'=>'tuesday'])@endcomponent
                @component('components.daySchedule',['day'=>'wednesday'])@endcomponent
                @component('components.daySchedule',['day'=>'thursday'])@endcomponent
                @component('components.daySchedule',['day'=>'friday'])@endcomponent
                @component('components.daySchedule',['day'=>'saturday'])@endcomponent
                @component('components.daySchedule',['day'=>'sunday'])@endcomponent
                 <div class="form-group">
                    <div class="col-md-3 col-md-offset-2">
                        <button id="save-schedule" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('pageScripts')
    @include('schedule.script')
@stop