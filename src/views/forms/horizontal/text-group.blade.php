<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    <label class="col-sm-2 control-label">{{$label}}</label>
    <div class="col-sm-10">
        <input {!! html_attributes($attr ?? []) !!} class="form-control" type="text" name="{{$name}}" value="{{$value}}"  />
        @if($errors->has($name))
            <span class="help-block">{{$errors->first($name)}}</span>
        @endif
    </div>
</div>