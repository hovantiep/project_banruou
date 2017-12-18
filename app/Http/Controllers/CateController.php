<?php

namespace banruou\Http\Controllers;

use banruou\Cate;
use banruou\Http\Requests\CateRequest;
use Illuminate\Http\Request;

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

    public function getEdit($id)
    {
        $cate = Cate::find($id);
        $parent = Cate::select('id', 'name', 'parent_id')->where('id', '!=', $id)->get();
        return view('admin.cate.edit')
            ->with('cate', $cate)
            ->with('parent', $parent);
    }

    public function postEdit($id, Request $request)
    {
        $this->validate($request,
            ['txtCateName' => 'required'],
            ['txtCateName.required' => 'Vui lòng nhập tên Cate!']
        );
        $cate = Cate::find($id);

        $cate->name = $request->txtCateName;
        $cate->alias = strToSlug($request->txtCateName);
        $cate->order = $request->txtOrder;
        $cate->parent_id = $request->sltCate;
        $cate->keywords = $request->txtKeywords;
        $cate->description = $request->txtDescription;
        $cate->save();
        return redirect()->route('admin.cate.getList')
            ->with(['level' => 'success', 'flash_message' => 'Cập nhật thành công!']);

    }
}
