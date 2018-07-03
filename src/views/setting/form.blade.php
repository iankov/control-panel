<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <input type="hidden" name="type" value="{{$setting->type}}">
            @include('icp::forms.horizontal.text-group', ['name' => 'type', 'label' => 'Type', 'value' => $setting->type_name, 'attr' => ['disabled' => 1]])
            @include('icp::forms.horizontal.text-group', ['name' => 'name', 'label' => 'Name', 'value' => old('name', $setting->name)])
            @include('icp::forms.horizontal.text-group', ['name' => 'key', 'label' => 'Key', 'value' => old('key', $setting->key)])

            @switch($setting->type)
                @case(\Iankov\ControlPanel\Models\Setting::TYPE_TEXT)
                @case(\Iankov\ControlPanel\Models\Setting::TYPE_JSON)
                    @include('icp::forms.horizontal.textarea-group', [
                        'name' => 'value',
                        'label' => 'Value',
                        'value' => old('value', $setting->value),
                        'attr' => ['rows' => 15, 'data-name' => 'value', 'data-type' => 'textarea']
                    ])
                    @break

                @case(\Iankov\ControlPanel\Models\Setting::TYPE_INT)
                @case(\Iankov\ControlPanel\Models\Setting::TYPE_FLOAT)
                    @include('icp::forms.horizontal.text-group', [
                        'name' => 'value',
                        'label' => 'Value',
                        'value' => old('value', $setting->value),
                        'attr' => ['data-name' => 'value', 'data-type' => 'text']
                    ])
                    @break

                @case(\Iankov\ControlPanel\Models\Setting::TYPE_BOOL)
                    @include('icp::forms.horizontal.select-group', [
                        'name' => 'value',
                        'label' => 'Value',
                        'value' => old('value', $setting->value),
                        'items' => [0 => 'FALSE', 1 => 'TRUE'],
                        'attr' => ['data-name' => 'value', 'data-type' => 'select']
                    ])
                    @break
            @endswitch

            @include('icp::forms.horizontal.checkbox-group', ['name' => 'active', 'value' => old('active', $setting->active), 'label' => 'Active'])
        </div>

        <div class="col-md-6">

        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        Icp.iCheck('input[name=active]');
    });
</script>

<div class="box-footer">
    <a href="{{icp_route('settings')}}" class="btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-success">Save</button>
</div>