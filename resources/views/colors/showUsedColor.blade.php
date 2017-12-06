<li class="color-list-item" style="background:{{$color->hexCode}};">
    {!! Form::open(['method' => 'DELETE','route' => ['colors.destroy', $color->id],'style'=>'display:none', 'id'=>'delete-color-form']) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <span>{{$color->user()->pluck('first_name')->first()}}</span>

</li>
