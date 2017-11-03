<li class="color-list-item" data-color-id="{{$color->id}}" style="background:{{$color->hexCode}};
@if ($color->user_id)
        opacity: .8;">{{$color->user()->pluck('first_name')->first()}}
    @else
        ">
    @endif
</li>
