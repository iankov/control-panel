<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            @include('icp::forms.horizontal.text-group', ['name' => 'name', 'label' => 'Name', 'value' => old('name', $setting->name)])
            @include('icp::forms.horizontal.select-group', [
                'name' => 'type',
                'label' => 'Type',
                'value' => old('type', $setting->type),
                'items' => $types
            ])
            @include('icp::forms.horizontal.text-group', ['name' => 'key', 'label' => 'Key', 'value' => old('key', $setting->key)])

            @include('icp::forms.horizontal.textarea-group', [
                'name' => 'value',
                'label' => 'Value',
                'value' => old('value', $setting->value),
                'attr' => ['rows' => 15, 'data-name' => 'value', 'data-type' => 'textarea']
            ])
            @include('icp::forms.horizontal.text-group', [
                'name' => 'value',
                'label' => 'Value',
                'value' => old('value', $setting->value),
                'attr' => ['data-name' => 'value', 'data-type' => 'text']
            ])
            @include('icp::forms.horizontal.select-group', [
                'name' => 'value',
                'label' => 'Value',
                'value' => old('value', $setting->value),
                'items' => [0 => 'FALSE', 1 => 'TRUE'],
                'attr' => ['data-name' => 'value', 'data-type' => 'select']
            ])

            <div class="form-group">
                <label class="col-sm-2 control-label">Active</label>
                <div class="col-sm-10">
                    <div class="checkbox">
                        <input name="active" type="checkbox" {{old('active', $setting->active) ? 'checked' : ''}} />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">

        </div>
    </div>
</div>

<script type="text/javascript">
    var switchFields = function(type){
        console.log(type);
        var $field = $('[data-name=value]');
        $field.removeAttr('name');
        $field.closest('.form-group').hide();

        var $visibleField = $field.filter('[data-type='+type+']');
        $visibleField.attr('name', 'value');
        $visibleField.closest('.form-group').show();
    };

    $('[name=type]').change(function(){
        var type = parseInt($(this).val());
        switch(type){
            case {{\Iankov\ControlPanel\Models\Setting::TYPE_TEXT}}:
            case {{\Iankov\ControlPanel\Models\Setting::TYPE_JSON}}:
                switchFields('textarea');
                break;
            case {{\Iankov\ControlPanel\Models\Setting::TYPE_INT}}:
            case {{\Iankov\ControlPanel\Models\Setting::TYPE_FLOAT}}:
                switchFields('text');
                break;
            case {{\Iankov\ControlPanel\Models\Setting::TYPE_BOOL}}:
                switchFields('select');
                break;
        }
    }).change();

    $(function(){
        Icp.iCheck('input[name=active]');
    });
</script>

<div class="box-footer">
    <a href="{{icp_route('settings')}}" class="btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-success">Save</button>
</div>