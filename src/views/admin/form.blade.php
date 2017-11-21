<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name" placeholder="John Mitchel" value="{{old('name', $user->name)}}"  />
                    @if($errors->has('name'))
                        <span class="help-block">{{$errors->first('name')}}</span>
                    @endif
                </div>
            </div>

            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="email" placeholder="john@gmail.com" value="{{old('email', $user->email)}}"  />
                    @if($errors->has('email'))
                        <span class="help-block">{{$errors->first('email')}}</span>
                    @endif
                </div>
            </div>

            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="password" placeholder="{{$user->id > 0 ? '*************' : 'Password'}}" value="{{old('password')}}"  />
                    @if($errors->has('password'))
                        <span class="help-block">{{$errors->first('password')}}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>
<div class="box-footer">
    <button type="button" class="btn btn-default" onclick="document.location.href='{{icp_route('admins')}}'">Cancel</button>
    <button type="submit" class="btn btn-success">Save</button>
</div>