@php
    $attr = $attr ?? [];
    $attr['rows'] = isset($attr['rows']) ? $attr['rows'] : '3';
@endphp
<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    <label class="col-sm-2 control-label">{{$label}}</label>
    <div class="col-sm-10">
        <textarea {!! html_attributes($attr) !!} class="form-control" name="{{$name}}">{{$value}}</textarea>
        @if($errors->has($name))
            <span class="help-block">{{$errors->first($name)}}</span>
        @endif
    </div>
</div>