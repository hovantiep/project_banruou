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
//      Pagination
        $productCates = Product::select('id', 'name', 'alias', 'price', 'image', 'cate_id')->where('cate_id', $id)->orderBy('id', 'DESC')->paginate(2);

        // menu cate (left)
        $cate = Cate::select('parent_id')->where('id', $id)->first();
        $menuCate = Cate::select('id', 'name', 'alias')->where('parent_id', $cate->parent_id)->get();

        $latestProduct = Product::select('id', 'name', 'alias', 'price', 'image')->orderBy('id', 'DESC')->skip(0)->take(4)->get();
        $nameCate = DB::table('cates')->select('name')->where('id', $id)->first();

        $mustHave = Product::select('name', 'image')->orderBy(DB::raw('RAND()'))->take(2)->get();

        return view('user.pages.category')
            ->with('productCates', $productCates)
            ->with('menuCate', $menuCate)
            ->with('latestProduct', $latestProduct)
            ->with('mustHave', $mustHave)
            ->with('nameCate', $nameCate);
    }

    public function chiTietSanPham($id)
    {
        $product = Product::find($id);

        $cate = $product->cate_id;
        $related = Product::select('id','name','image','price','alias')->where('cate_id',$cate)->orderBy(DB::raw('RAND()'))->take(4)->get();

        $imageDetail = $product->productImage;

        return view('user.pages.product')
            ->with('product', $product)
            ->with('related',$related)
            ->with('imageDetail',$imageDetail);
    }
}
