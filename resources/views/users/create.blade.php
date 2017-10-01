@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 id="add_user_title">Add a new user</h1>
        <div class="create_user_form_container">
            <form class="form-horizontal" method="POST" action="{{ route('user_store') }}">
                {{ csrf_field() }}

                @include('components.userForm')

                <div class="form-group">
                    <div class="col-md-3 col-md-offset-2">
                        <button type="submit" class="btn btn-success">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection