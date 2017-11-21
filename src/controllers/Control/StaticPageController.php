<?php

namespace Iankov\ControlPanel\Controllers\Control;

use Iankov\ControlPanel\Controllers\Controller;
use Iankov\ControlPanel\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function index()
    {
        return view('icp::static.index', [
            'pages' => StaticPage::all()
        ]);
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
            'route' => 'unique:static_pages,route,'.$id
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
        $page = StaticPage::find($id);
        if($page){
            $page->active = $page->active ? 0 : 1;
            $page->save();
        }

        return redirect()->back();
    }

    public function delete($id){
        StaticPage::find($id)->delete();

        return redirect(icp_route('static'));
    }
}