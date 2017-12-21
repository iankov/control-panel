<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            @include('icp::forms.horizontal.text-group', ['name' => 'name', 'label' => 'Name', 'value' => old('name', $page->name)])
            @include('icp::forms.horizontal.text-group', ['name' => 'route', 'label' => 'Route', 'value' => old('route', $page->route)])
            @include('icp::forms.horizontal.textarea-group', [
                'name' => 'content',
                'label' => 'Content',
                'value' => old('content', $page->content),
                'attr' => ['rows' => 15]
            ])

            <div class="form-group">
                <label class="col-sm-2 control-label">Active</label>
                <div class="col-sm-10">
                    <div class="checkbox">
                        <input name="active" type="checkbox" {{old('active', $page->active) ? 'checked' : ''}} />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">

        </div>
    </div>
</div>

<div class="box-footer">
    <a href="{{icp_route('static')}}" class="btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-success">Save</button>
</div>

<script type="text/javascript">
    $(function(){
        Icp.iCheck('input[name=active]');
    });
</script>