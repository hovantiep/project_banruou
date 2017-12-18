<?php

namespace banruou\Http\Controllers;

use banruou\Cate;
use banruou\Http\Requests;
use banruou\Product;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('auth',['except' => [
            'index',
        ]]);*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lay ngau nhien sp
        $featuredProduct = Product::select('id', 'name', 'alias', 'price', 'image')->orderBy(DB::raw('RAND()'))->skip(0)->take(4)->get();

        // Lay sp duoc them sau cung
        $latestProduct = Product::select('id', 'name', 'alias', 'price', 'image')->orderBy('id', 'DESC')->skip(0)->take(4)->get();

        return view('.user.pages.home')
            ->with('latestProduct', $latestProduct)
            ->with('featuredProduct', $featuredProduct);
    }

    public function loaiSanPham($id)
    {
        //lay parent_id
        $parentId = Cate::with('product')
            ->where('id', $id)
            ->select('parent_id')
            ->first();

        //parent_id = 0 -> category all sub
        if($parentId->parent_id == 0){
            //lay products: ket noi 2 bang loc theo id co parent_id=0
            $productCates = DB::table('products')
                ->join('cates', 'cate_id', '=', 'cates.id')
                ->where('parent_id', $id)
                ->select('products.id', 'products.name', 'products.alias', 'products.price', 'products.image', 'cate_id')
                ->orderBy('products.id', 'DESC')
                ->paginate(9);

            // for category (left)
            $latestProduct = DB::table('products')
                ->join('cates', 'cate_id', '=', 'cates.id')
                ->where('parent_id', $id)
                ->select('products.id', 'products.name', 'products.alias', 'products.price', 'products.image', 'cate_id')
                ->orderBy('products.id', 'DESC')
                ->take(4)
                ->get();
            $nameCate = Cate::with('product')
                ->where('id', $id)
                ->select('cates.name')
                ->first();
            $bestSeller = DB::table('products')
                ->join('cates', 'cate_id', '=', 'cates.id')
                ->where('parent_id', $id)
                ->select('products.id', 'products.name', 'products.alias', 'products.price', 'products.image', 'cate_id')
                ->orderBy('products.price')
                ->take(4)
                ->get();
        }
        else{
            $productCates = Product::select('id', 'name', 'alias', 'price', 'image', 'cate_id')
                ->where('cate_id', $id)
                ->orderBy('id', 'DESC')
                ->paginate(9);

            // for category (left)
            $latestProduct = Product::select('id', 'name', 'alias', 'price', 'image')->where('cate_id', $id)->orderBy('id', 'DESC')->skip(0)->take(4)->get();
            $nameCate = DB::table('cates')->select('name')->where('id', $id)->first();
            $bestSeller = Product::select('id', 'name', 'alias', 'price', 'image', 'cate_id')->where('cate_id', $id)->orderBy('price')->take(4)->get();
        }
        //menu left
        $cate = Cate::select('parent_id')->where('id', $id)->first();
        $menuCate = Cate::select('id', 'name', 'alias')->where('parent_id', $cate->parent_id)->get();

        // sp ngau nhien
        $mustHave = Product::select('name', 'image')->orderBy(DB::raw('RAND()'))->take(2)->get();

        return view('user.pages.category')
            ->with('productCates', $productCates)
            ->with('menuCate', $menuCate)
            ->with('latestProduct', $latestProduct)
            ->with('mustHave', $mustHave)
            ->with('nameCate', $nameCate)
            ->with('bestSeller', $bestSeller);
    }

    public function chiTietSanPham($id)
    {
        $product = Product::find($id);
        $cateId = $product->cate_id;
        // lay san pham cung danh muc (loai tru sp dang xem)
        $related = Product::select('id', 'name', 'image', 'price', 'alias')
            ->where('cate_id', $cateId)
            ->where('id','<>', $id)
            ->orderBy(DB::raw('RAND()'))
            ->take(4)
            ->get();

        //lay tat ca hinh trong product_image
        $imageDetail = $product->productImage;

        //lay ra ten cate
        $nameCate = Cate::select('name','id', 'alias')
            ->where('id', $cateId)
            ->first();

        return view('user.pages.product')
            ->with('product', $product)
            ->with('related', $related)
            ->with('imageDetail', $imageDetail)
            ->with('nameCate', $nameCate);
    }

    public function getLienHe()
    {
        return view('user.pages.contact');
    }

    public function postLienHe(Request $request)
    {
        $data = ['hoten' => $request->name, 'mail' => $request->email, 'noidung' => $request->message];
        Mail::send('auth.emails.myEmail', $data, function ($msg) {
            $msg->from('hero.tiep.88@gmail.com', 'Tiep');
            $msg->to('hovantiep1989@gmail.com', 'admin website')->subject('Project Laravel 5x');
        });
        echo '<script>
        alert("Cảm ơn bạn đã góp ý, chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất!");
        window.location = "' . url('/') . '"';
        echo "</script>";
    }

    public function muaHang($id)
    {
        $productBuy = Product::find($id);
        Cart::add(['id' => $id, 'name' => $productBuy->name, 'qty' => 1, 'price' => $productBuy->price, 'options' => ['img' => $productBuy->image]]);

        return redirect()->route('gioHang');
    }

    public function gioHang()
    {
        $data = Cart::content();
        $total = Cart::total();
        return view('user.pages.shopping-cart')
            ->with('data', $data)
            ->with('total', $total);
    }

    public function xoaHangMua($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('gioHang');
    }

    public function capNhatHang($rowId, $qty)
    {
        Cart::update($rowId, ['qty'=>$qty]);
        echo 'OK';
    }
}
