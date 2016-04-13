<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class ProductController extends Controller
{
    public function getAdd()
    {
        //$parent = Cate::select('id', 'name', 'parent_id')->get();
        return view('admin.product.add');
    }

    public function postAdd()
    {
//        $cate = new Cate();
//        $cate->name = $request->txtCateName;
//        $cate->alias = strToSlug($request->txtCateName);
//        $cate->order = $request->txtOrder;
//        $cate->parent_id = $request->sltCate;
//        $cate->keywords = $request->txtKeywords;
//        $cate->description = $request->txtDescription;
//        $cate->save();
        return redirect()->route('admin.product.getList');
//            ->with(['level' => 'success', 'flash_message' => 'Thêm thành công!']);
    }

    public function getList()
    {
//        $cates = Cate::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get();
        return view('admin.product.list');
//            ->with('cates', $cates)
//            ->with('i', 1);
    }
}
