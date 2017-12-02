<?php

namespace Iankov\ControlPanel\Controllers\Control;

use Iankov\ControlPanel\Controllers\Controller;
use Iankov\ControlPanel\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(){
        return view('icp::admin.index');
    }

    public function jsonIndex()
    {
        return Datatables::of(Admin::select('id', 'active', 'name', 'email', 'updated_at'))
            ->editColumn('updated_at', function($item){
                return $item->updated_at->format('d M Y, H:i:s');
            })
            ->editColumn('active', function ($item) {
                return view('icp::forms.active', [
                    'active' => $item->active,
                    'action' => icp_route('admin.active.toggle', $item->id),
                ]);
            })
            ->addColumn('actions', function($item){
                return
                    view('icp::forms.buttons.edit', ['action' => icp_route('admin.edit', $item->id)]).'&nbsp;'.
                    view('icp::forms.buttons.delete', ['action' => icp_route('admin.delete', $item->id)]);
            })
            ->addColumn('checkbox', function($item){
                return '<input type="checkbox" name="ids[]" value="'.$item->id.'">';
            })
            ->rawColumns(['active', 'actions', 'checkbox'])
            ->with(['csrf_token' => csrf_token()])
            ->make(true);
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

        $data['active'] = empty($all['active']) ? 0 : 1;

        if(!empty($all['password']) || $id == 0){
            $rules['password'] = 'required|min:'.config('icp.modules.admins.password-min-length');
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

    public function toggleActive($id)
    {
        $admin = Admin::find($id);
        if($admin){
            if($admin->active){
                $actives = Admin::where('active', 1)->count();
                if($actives == 1){
                    return response()->json(['message' => '
                        This is the last active administrator. 
                        You can\'t disable it, otherwise nobody would be able to authorize control panel.'
                    ], 400);
                }
            }
            $admin->active = $admin->active ? 0 : 1;
            $admin->save();
        }

        return response()->json();
    }

    public function delete($id = null)
    {
        $ids = request()->input('ids');
        $ids = is_array($ids) ? $ids : [$id];

        $activesLeft = Admin::whereNotIn('id', $ids)->where('active', 1)->count();
        if($activesLeft == 0){
            return response()->json(['message' => 'You can\'t delete all active admins. You have to leave at least one active.'], 400);
        }

        Admin::whereIn('id', $ids)->delete();

        return response()->json();
    }
}