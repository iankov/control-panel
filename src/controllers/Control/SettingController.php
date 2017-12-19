<?php

namespace Iankov\ControlPanel\Controllers\Control;

use Iankov\ControlPanel\Controllers\Controller;
use Iankov\ControlPanel\Models\Setting;
use Iankov\ControlPanel\Rules\Json;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    public function index()
    {
        return view('icp::setting.index');
    }

    public function jsonIndex()
    {
        return Datatables::of(Setting::select('id', 'active', 'name', 'type', 'key', 'value', 'updated_at'))
            ->editColumn('updated_at', function($item){
                return $item->updated_at->format('d M Y, H:i:s');
            })
            ->editColumn('active', function ($item) {
                return view('icp::forms.active', [
                    'active' => $item->active,
                    'action' => icp_route('setting.active.toggle', $item->id),
                ]);
            })
            ->editColumn('type', function($item){
                return Setting::getTypes()[$item->type];
            })
            ->editColumn('value', function($item){
                return view('icp::setting.index-value-cell', ['setting' => $item]);
            })
            ->addColumn('actions', function($item){
                return
                    view('icp::forms.buttons.edit', ['action' => icp_route('setting.edit', $item->id)]).'&nbsp;'.
                    view('icp::forms.buttons.delete', ['action' => icp_route('setting.delete', $item->id)]);
            })
            ->addColumn('checkbox', function($item){
                return '<input type="checkbox" name="ids[]" value="'.$item->id.'">';
            })
            ->rawColumns(['active', 'value', 'actions', 'checkbox'])
            ->with(['csrf_token' => csrf_token()])
            ->make(true);
    }

    public function edit($id)
    {
        return view('icp::setting.edit', [
            'setting' => Setting::find($id),
            'types' => Setting::getTypes()
        ]);
    }

    public function create()
    {
        return view('icp::setting.create', [
            'setting' => new Setting(),
            'types' => Setting::getTypes()
        ]);
    }

    public function store(Request $request)
    {
        return $this->update($request, 0);
    }

    public function update(Request $request, $id)
    {
        switch($request->type) {
            case Setting::TYPE_JSON:
                $valueRule = 'json';//new Json();
                break;
            case Setting::TYPE_INT:
                $valueRule = 'integer';
                break;
            case Setting::TYPE_FLOAT:
                $valueRule = 'numeric';
                break;
            case Setting::TYPE_BOOL:
                $valueRule = 'boolean';
                break;
            default:
                $valueRule = '';
        }

        $this->validate($request, [
            'name' => 'required',
            'type' => 'required|in:'.implode(',', array_keys(Setting::getTypes())),
            'key' => 'required|unique:settings,key,'.$id,
            'value' => [
                'required',
                $valueRule
            ]
        ]);

        $all = $request->all();
        $all['active'] = empty($all['active']) ? 0 : 1;

        if($id) {
            Setting::find($id)->fill($all)->save();
        }else{
            Setting::create($all);
        }

        return redirect(icp_route('settings'));
    }

    public function toggleActive($id)
    {
        $setting = Setting::find($id);
        if($setting){
            $setting->active = $setting->active ? 0 : 1;
            $setting->save();
        }

        return response()->json();
    }

    public function delete($id = null)
    {
        $ids = request()->input('ids');
        $ids = is_array($ids) ? $ids : [$id];

        Setting::whereIn('id', $ids)->delete();

        return response()->json();
    }
}