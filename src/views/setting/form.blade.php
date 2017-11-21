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
                'attr' => ['rows' => 15]
            ])

            <div class="form-group">
                <label class="col-sm-2 control-label">Active</label>
                <div class="col-sm-10">
                    <div class="checkbox icheck">
                        <label>
                            <input name="active" type="checkbox" {{old('active', $setting->active) ? 'checked' : ''}} />
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">

        </div>
    </div>
</div>

<div class="box-footer">
    <a href="{{icp_route('settings')}}" class="btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-success">Save</button>
</div>