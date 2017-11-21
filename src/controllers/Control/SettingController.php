<?php

namespace Iankov\ControlPanel\Controllers\Control;

use Iankov\ControlPanel\Controllers\Controller;
use Iankov\ControlPanel\Models\Setting;
use Iankov\ControlPanel\Rules\Json;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('icp::setting.index', [
            'settings' => Setting::all()
        ]);
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
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required|in:'.implode(',', array_keys(Setting::getTypes())),
            'key' => 'required|unique:settings,key,'.$id,
            'value' => [
                'required',
                $request->type == Setting::TYPE_JSON ? new Json() : ''
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

        return redirect()->back();
    }

    public function delete($id){
        Setting::find($id)->delete();

        return redirect(icp_route('settings'));
    }
}