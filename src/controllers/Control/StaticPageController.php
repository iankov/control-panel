<?php

namespace Iankov\ControlPanel\Controllers\Control;

use Iankov\ControlPanel\Controllers\Controller;
use Iankov\ControlPanel\Models\StaticPage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StaticPageController extends Controller
{
    public function index()
    {
        return view('icp::static.index');
    }

    public function jsonIndex()
    {
        return Datatables::of(StaticPage::select('id', 'active', 'name', 'route', 'updated_at'))
            ->editColumn('updated_at', function($item){
                return $item->updated_at->format('d M Y, H:i:s');
            })
            ->editColumn('active', function ($item) {
                return view('icp::forms.active', [
                    'active' => $item->active,
                    'action' => icp_route('static.active.toggle', $item->id),
                ]);
            })
            ->addColumn('actions', function($item){
                return
                    view('icp::forms.buttons.edit', ['action' => icp_route('static.edit', $item->id)]).'&nbsp;'.
                    view('icp::forms.buttons.delete', ['action' => icp_route('static.delete', $item->id)]);
            })
            ->addColumn('checkbox', function($item){
                return '<input type="checkbox" name="ids[]" value="'.$item->id.'">';
            })
            ->rawColumns(['active', 'actions', 'checkbox'])
            ->with(['csrf_token' => csrf_token()])
            ->make(true);
    }

    public function edit($id)
    {
        return view('icp::static.edit', [
            'page' => StaticPage::find($id)
        ]);
    }

    public function create()
    {
        return view('icp::static.create', [
            'page' => new StaticPage()
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
            'route' => 'required|unique:static_pages,route,'.$id
        ]);

        $all = $request->all();
        $all['active'] = empty($all['active']) ? 0 : 1;

        if($id) {
            StaticPage::find($id)->fill($all)->save();
        }else{
            StaticPage::create($all);
        }

        return redirect(icp_route('static'));
    }

    public function toggleActive($id)
    {
        $static = StaticPage::find($id);
        if($static){
            $static->active = $static->active ? 0 : 1;
            $static->save();
        }

        return response()->json();
    }

    public function delete($id = null)
    {
        $ids = request()->input('ids');
        $ids = is_array($ids) ? $ids : [$id];

        StaticPage::whereIn('id', $ids)->delete();

        return response()->json();
    }
}