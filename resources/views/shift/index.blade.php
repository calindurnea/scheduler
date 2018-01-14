@extends('layouts.app')

@section('content')
    @if(\Session::has('error'))
        <div class="alert alert-danger col-md-2 pull-right">
            {{\Session::get('error')}}
        </div>
    @endif
    <div id='calendar'></div>
@endsection

@section('pageScripts')
    @include('shift.script')
@stop