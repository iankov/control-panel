<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            @include('icp::forms.horizontal.text-group', ['label' => 'Name', 'name' => 'name', 'value' => old('name', $user->name), 'attr' => ['placeholder' => 'John Mitchel']])
            @include('icp::forms.horizontal.text-group', ['label' => 'Email', 'name' => 'email', 'value' => old('email', $user->email), 'attr' => ['placeholder' => 'john@gmail.com']])
            @include('icp::forms.horizontal.text-group', [
                'name' => 'password',
                'label' => 'Password',
                'value' => old('password'),
                'attr' => ['placeholder' => $user->id > 0 ? '*************' : 'Password']
            ])

            @include('icp::forms.horizontal.checkbox-group', ['name' => 'active', 'value' => old('active', $user->active), 'label' => 'Active'])
        </div>
        <div class="col-md-6"></div>
    </div>
</div>
<div class="box-footer">
    <button type="button" class="btn btn-default" onclick="document.location.href='{{icp_route('admins')}}'">Cancel</button>
    <button type="submit" class="btn btn-success">Save</button>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        Icp.iCheck('input[name=active]');
    });
</script>