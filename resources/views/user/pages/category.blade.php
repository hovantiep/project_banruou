@extends('user.master')
@section('description','')
@section('content')
    <section id="product">
        <div class="container">
            <!--  breadcrumb -->
            <ul class="breadcrumb">
                <li>
                    <a href="{!! url('/') !!}">MAIN PAGE</a>
                    <span class="divider">/</span>
                </li>
                <li class="active">{{ $nameCate->name }} </li>
            </ul>
            <div class="row">
                <!-- Sidebar Start-->
                <aside class="span3">
                    <!-- Category-->
                    <div class="sidewidt">
                        <h2 class="heading2"><span>SAME TYPE</span></h2>
                        <ul class="nav nav-list categories">
                            @foreach($menuCate as $item)
                                <li>
                                    <a href="{{ route('loaiSanPham',[$item->id,$item->alias]) }}">{!! $item->name !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--  Best Seller -->
                    <div class="sidewidt">
                        <h2 class="heading2"><span>GOOD PRICE</span></h2>
                        <ul class="bestseller">
                            @foreach($bestSeller as $item)
                            <li>
                                <img width="50" height="50" src="{!! url('resources/upload/'.$item->image) !!}" alt="product" title="product">
                                <a class="productname" href="{!! route("chiTietSanPham",[$item->id,$item->alias]) !!}"> {!! $item->name !!}</a>
                                <span class="procategory">{!! $nameCate->name !!}</span>
                                <span class="price">{!! number_format($item->price,0,',','.') !!}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Latest Product -->
                    <div class="sidewidt">
                        <h2 class="heading2"><span>NEW ITEMS</span></h2>
                        <ul class="bestseller">
                            @foreach($latestProduct as $item)
                                <li>
                                    <img width="50" height="50" src="{!! url('resources/upload/'.$item->image) !!}"
                                         alt="product" title="product">
                                    <a class="productname" href="{!! route("chiTietSanPham",[$item->id,$item->alias]) !!}"> {!! $item->name !!}</a>
                                    <span class="procategory">{!! $nameCate->name !!}</span>
                                    <span class="price">{!! number_format($item->price,0,',','.') !!}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--  Must have -->
                    <div class="sidewidt">
                        <h2 class="heading2"><span></span></span></h2>

                        <div class="flexslider" id="mainslider">
                            <ul class="slides">
                                @foreach($mustHave as $item)
                                    <li>
                                        <img src="{!! url('resources/upload/'.$item->image) !!}"
                                             alt="{!! $item->name !!}"/>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </aside>
                <!-- Sidebar End-->
                <!-- Category-->
                <div class="span9">
                    <!-- Category Products-->
                    <section id="category">
                        <div class="row">
                            <div class="span9">
                                <!-- Category-->
                                <section id="categorygrid">
                                    <ul class="thumbnails grid">
                                        @foreach($productCates as $item)
                                            <li class="span3">
                                                <a class="prdocutname"
                                                   href="{!! route("chiTietSanPham",[$item->id,$item->alias]) !!}">{!! $item->name !!}</a>

                                                <div class="thumbnail">
                                                    <span class="sale tooltip-test">Sale</span>
                                                    <a href="{!! route("chiTietSanPham",[$item->id,$item->alias]) !!}"><img
                                                                alt=""
                                                                src="{!! url('resources/upload/'.$item->image) !!}"></a>

                                                    <div class="pricetag">
                                                        <span class="spiral"></span><a href="#" class="productcart">ADD TO CART</a>
                                                        <div class="price">
                                                            <div class="pricenew">{!! number_format($item->price,0,',','.') !!}</div>
                                                            <div class="priceold"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="pagination pull-right">
                                        <ul>
                                            @if($productCates->currentPage()!=1)
                                                <li>
                                                    <a href="{!! $productCates->url($productCates->currentPage()-1) !!}">Prev</a>
                                                </li>
                                            @endif
                                            @for($i=1;$i<=$productCates->lastPage();$i++)
                                                <li {!! ($productCates->currentPage()==$i) ? 'class="active"' : null !!}>
                                                    <a href="{{ $productCates->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            @if($productCates->currentPage()!=$productCates->lastPage())
                                                <li>
                                                    <a href="{!! $productCates->url($productCates->currentPage()+1) !!}">Next</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection