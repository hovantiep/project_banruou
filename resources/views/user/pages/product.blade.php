@extends('user.master')
@section('description','Đây là trang chủ')
@section('content')

    <section id="product">
        <div class="container">
            <!-- Product Details-->
            <div class="row">
                <!-- Left Image-->
                <div class="span5">
                    <ul class="thumbnails mainimage">
                        @foreach($imageDetail as $item)
                            <li class="span5">
                                <a  rel="position: 'inside' , showTitle: false, adjustX:-4, adjustY:-4" class="thumbnail cloud-zoom" href="{!! url('resources/upload/detail/'.$item->image) !!}">
                                    <img src="{!! url('resources/upload/detail/'.$item->image) !!}" alt="hinh anh chi tiet sp" title="dsfdsfs">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="thumbnails mainimage">
                        @foreach($imageDetail as $item)
                            <li class="producthtumb">
                                <a class="thumbnail" >
                                    <img  src="{!! url('resources/upload/detail/'.$item->image) !!}" alt="" title="">
                                </a>
                        @endforeach
                    </ul>
                </div>
                <!-- Right Details-->
                <div class="span7">
                    <div class="row">
                        <div class="span7">
                            <h1 class="productname"><span class="bgnone">{!! $product->name !!}</span>
                            </h1>

                            <div class="productprice">
                                <div class="productpageprice">
                                    <span class="spiral"></span>{!! number_format($product->price,0,',','.') !!}
                                </div>
                            </div>
                            <ul class="productpagecart">
                                <li><a class="cart" href="#">Add to Cart</a>
                                </li>
                            </ul>
                            <!-- Product Description tab & comments-->
                            <div class="productdesc">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a href="#description">Description</a>
                                    </li>
                                    <li><a href="#content">Content</a>
                                    </li>
                                    <li><a href="#review">Intro</a>
                                    </li>
                                    <li><a href="#producttag">Tags</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="description">
                                        {!! $product->description !!}
                                    </div>
                                    <div class="tab-pane " id="content">
                                        {!! $product->content !!}
                                    </div>
                                    <div class="tab-pane" id="review">
                                        {!! $product->intro !!}
                                    </div>
                                    <div class="tab-pane" id="producttag">
                                        <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy text ever since the
                                            1500s, when an unknown printer took a galley of type and scrambled it to
                                            make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged. It
                                            was popularised in the 1960s with the release of Letraset sheets containing
                                            Lorem Ipsum passages, and more recently with desktop publishing software
                                            like Aldus PageMaker including versions of Lorem Ipsum <br>
                                            <br>
                                        </p>
                                        <ul class="tags">
                                            <li><a href="#"><i class="icon-tag"></i> Webdesign</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> html</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> html</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> css</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> jquery</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> css</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> jquery</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> Webdesign</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> css</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> jquery</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> Webdesign</a>
                                            </li>
                                            <li><a href="#"><i class="icon-tag"></i> html</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h4> plugin facebook</h4>
        <div class="fb-comments" data-href="http://localhost/project_laravel/chi-tiet-san-pham/1/ao-thun" data-numposts="5"></div>
    </section>
    <!--  Related Products-->
    <section id="related" class="row">
        <div class="container">
            <h1 class="heading1"><span class="maintext">Related Products</span><span class="subtext"> See Our Most featured Products</span>
            </h1>
            <ul class="thumbnails">
                @foreach($related as $item)
                    <li class="span3">
                        <a class="prdocutname"
                           href="{!! route("chiTietSanPham",[$item->id,$item->alias]) !!}">{!! $item->name !!}</a>

                        <div class="thumbnail">
                            <span class="offer tooltip-test">Offer</span>
                            <a href="{!! route("chiTietSanPham",[$item->id,$item->alias]) !!}"><img alt=""
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
        </div>
    </section>
    <!-- Popular Brands-->
@endsection