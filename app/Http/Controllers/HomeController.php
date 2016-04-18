<?php

namespace App\Http\Controllers;

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
        $productCates = Product::select('id', 'name', 'alias', 'price', 'image')->where('cate_id', $id)->orderBy('id', 'DESC')->get();
        return view('user.pages.category')->with('productCates', $productCates);
    }
}
