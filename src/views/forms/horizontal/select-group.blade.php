@php
    $attr = $attr ?? [];
    $attr['class'] = $attr['class'] ?? 'form-control';
    unset($attr['name']);
@endphp
<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    <label class="{{$col1_class or 'col-sm-2'}} control-label">{{$label}}</label>
    <div class="{{$col2_class or 'col-sm-10'}}">
        <select {!! html_attributes($attr ?? []) !!} name="{{$name}}">

            @if(isset($prepend))
                @foreach($prepend as $key => $item)
                    <option value="{{$key}}">{{$item}}</option>
                @endforeach
            @endif

            @foreach($items as $key => $item)
                <?php if(is_object($item)){
                    $key = $item->id;
                    $item = $item->name;
                }elseif(is_array($item)){
                    $key = $item['id'];
                    $item = $item['name'];
                }
                ?>
                <option value="{{$key}}" {!! $key == $value ? 'selected="1"' : '' !!} >{{$item}}</option>
            @endforeach

        </select>
        @if($errors->has($name))
            <span class="help-block">{{$errors->first($name)}}</span>
        @endif
    </div>
</div>