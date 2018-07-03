@php
    $attr = $attr ?? [];
    $attr['type'] = $attr['type'] ?? 'checkbox';
    $attr['style'] = $attr['style'] ?? 'margin-left: 0';
    unset($attr['name']);
@endphp
<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    <label class="{{$col1_class or 'col-sm-2'}} control-label">{{$label}}</label>
    <div class="{{$col2_class or 'col-sm-10'}}">
        <div class="checkbox">
            <input name="{{html_field_name($name)}}" {!! html_attributes($attr ?? []) !!} {{$value ? 'checked' : ''}} />
            @if($errors->has($name))
                <span class="help-block">{{$errors->first($name)}}</span>
            @endif
        </div>
    </div>
</div>