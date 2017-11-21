<?php

namespace Iankov\ControlPanel\Controllers\Control;

use Iankov\ControlPanel\Controllers\Controller;
use Iankov\ControlPanel\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('icp::admin.index', [
            'users' => Admin::all()
        ]);
    }

    public function create(){
        return view('icp::admin.create', [
            'user' => new Admin()
        ]);
    }

    public function edit($id){
        return view('icp::admin.edit', [
            'user' => Admin::find($id)
        ]);
    }

    public function store(Request $request){
        return $this->update($request, 0);
    }

    public function update(Request $request, $id){
        $all = $request->all();

        $data = [
            'name' => $all['name'],
            'email' => $all['email']
        ];

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id
        ];

        if(!empty($all['password']) || $id == 0){
            $rules['password'] = 'required|min:6';
            $data['password'] = bcrypt($all['password']);
        }

        $this->validate($request, $rules);

        if($id > 0){
            Admin::find($id)->fill($data)->save();
        }else {
            Admin::create($data);
        }

        return redirect(icp_route('admins'))->with('success', 'Admin saved successfully');
    }

    public function delete($id){
        if(Admin::count() > 1){
            Admin::find($id)->delete();
            return redirect(icp_route('admins'))->with('success', 'Admin was removed');
        }else{
            return redirect(icp_route('admins'))->withErrors('It is not allowed to remove the last admin');
        }
    }
}