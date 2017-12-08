<div class="form-group">
    <label for="{{$day}}" class="col-md-2 col-xs-2 col-sm-3 control-label">{{$day}}</label>

    <div class="col-md-2 col-xs-8 col-sm-10">
        <input id="{{$day}}-start" type="text" class="form-control hour-picker" name="{{$day}}-start"
               required autofocus>
    </div>
    <div class="col-md-2 col-xs-8 col-sm-10">
        <input id="{{$day}}-end" type="text" class="form-control hour-picker" name="{{$day}}-end"
               required autofocus>
    </div>
</div>