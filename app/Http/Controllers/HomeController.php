<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Http\Requests;
use App\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featuredProduct = Product::select('id', 'name', 'alias', 'price', 'image')->orderBy(DB::raw('RAND()'))->skip(0)->take(4)->get();
        $latestProduct = Product::select('id', 'name', 'alias', 'price', 'image')->orderBy('id', 'DESC')->skip(0)->take(4)->get();

        return view('.user.pages.home')
            ->with('latestProduct', $latestProduct)
            ->with('featuredProduct', $featuredProduct);
    }

    public function loaiSanPham($id)
    {
        $productCates = Product::select('id', 'name', 'alias', 'price', 'image', 'cate_id')->where('cate_id', $id)->orderBy('id', 'DESC')->get();
        // menu cate (left)
        $cate = Cate::select('parent_id')->where('id', $productCates[0]->cate_id)->first();
        $menuCate = Cate::select('id', 'name', 'alias')->where('parent_id', $cate->parent_id)->get();

        $latestProduct = Product::select('id', 'name', 'alias', 'price', 'image')->orderBy('id', 'DESC')->skip(0)->take(4)->get();
        $nameCate = DB::table('cates')->select('name')->where('id',$id)->first();


        return view('user.pages.category')
            ->with('productCates', $productCates)
            ->with('menuCate', $menuCate)
            ->with('latestProduct',$latestProduct)
            ->with('nameCate', $nameCate);
    }
}
