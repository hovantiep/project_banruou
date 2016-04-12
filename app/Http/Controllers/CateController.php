<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Http\Requests\CateRequest;


class CateController extends Controller
{
    public function getAdd()
    {
        $parent = Cate::select('id', 'name', 'parent_id')->get();
        return view('admin.cate.add')->with('parent', $parent);
    }

    public function postAdd(CateRequest $request)
    {
        $cate = new Cate();
        $cate->name = $request->txtCateName;
        $cate->alias = strToSlug($request->txtCateName);
        $cate->order = $request->txtOrder;
        $cate->parent_id = $request->sltCate;
        $cate->keywords = $request->txtKeywords;
        $cate->description = $request->txtDescription;
        $cate->save();
        return redirect()->route('admin.cate.getList')
            ->with(['level' => 'success', 'flash_message' => 'Thêm thành công!']);
    }

    public function getList()
    {
        $cates = Cate::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get();
        return view('admin.cate.list')
            ->with('cates', $cates)
            ->with('i', 1);
    }

    public function getDelete($id)
    {
//         Ràng buộc khi xóa parent -> con mất cha -> sai
        $child = Cate::select('id')->where('parent_id', $id)->groupBy('parent_id')->count();
        if ($child > 0) {
            return redirect()->route('admin.cate.getList')
                ->with(['level' => 'danger', 'flash_message' => 'Xóa không thành công. Đây là mục cha, vui lòng xóa mục con trước!']);
        } else {
            Cate::find($id)->delete();
            return redirect()->route('admin.cate.getList')
                ->with(['level' => 'success', 'flash_message' => 'Xóa thành công!']);
        }


    }

    public function getEdit()
    {

        return view('admin.cate.edit');
    }

    public function postEdit()
    {

    }
}
