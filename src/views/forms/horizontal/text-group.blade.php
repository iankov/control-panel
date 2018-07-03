@php
    $attr = $attr ?? [];
    $attr['type'] = $attr['type'] ?? 'text';
    $attr['class'] = $attr['class'] ?? 'form-control';
    unset($attr['name'], $attr['value']);
@endphp
<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    <label class="{{$col1_class or 'col-sm-2'}} control-label">{{$label}}</label>
    <div class="{{$col2_class or 'col-sm-10'}}">
        <input name="{{html_field_name($name)}}" value="{{$value}}" {!! html_attributes($attr ?? []) !!} />
        @if($errors->has($name))
            <span class="help-block">{{$errors->first($name)}}</span>
        @endif
    </div>
</div>