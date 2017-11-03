@extends('layouts.app')
@section('content')
    <h1 class="mt-4 center_title">Colors</h1>
    <div class="col-xs-12 col-sm-12 col-md-8 col-xl-6 mx-auto">
        <ul class="color-list">
            @foreach($colors as $color)
                @include('colors.showUsedColor', ['$color' => $color])
            @endforeach
        </ul>
        <div class="container-add-colors">
            <button class="btn btn-primary pull-right btn-add-color">Add color</button>
        </div>
    </div>

@stop
@section('pageScripts')
        @include('colors.script')
@stop
