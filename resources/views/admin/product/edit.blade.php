@extends('admin.master')
@section('controller','Product')
@section('action','Edit')
@section('content')
    <style>
        .img-thumbnail-current {
            max-width: 250px;
        }

        .img-thumbnail-detail {
            max-width: 200px;
        }
        #insert{margin-top: 20px;}

        /*.icon_del{position:relative;top: -100px;left: -35px;}*/
    </style>
    @include('admin.block.vali_msg')
    <form action="" method="POST">
        <div class="col-lg-7" style="padding-bottom:120px">
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="sltCate">
                    <option value="0">Please Choose Category</option>
                    {!! cate_parent($cate, 0, "", $product->cate_id) !!}
                </select>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="txtName" placeholder="Please Enter Username"
                       value="{!! old('txtName',$product->name) !!}"/>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" name="txtPrice" placeholder="Please Enter Password"
                       value="{!! old('txtPrice',$product->price) !!}"/>
            </div>
            <div class="form-group">
                <label>Intro</label>
                <textarea class="form-control" rows="3"
                          name="txtIntro">{!! old('txtIntro',$product->intro) !!}</textarea>
                <script>ckeditor('txtIntro')</script>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea class="form-control" rows="3"
                          name="txtContent">{!! old('txtContent',$product->content) !!}</textarea>
                <script>ckeditor('txtContent')</script>

            </div>
            <div class="form-group">
                <label>Images Current</label>
                <img src="{!! asset('resources/upload/'.$product->image) !!}" alt="{!! $product->image !!}"
                     class="img-responsive img-thumbnail img-thumbnail-current">
            </div>
            <div class="form-group">
                <label>Images</label>
                <input type="file" name="fImages">
            </div>
            <div class="form-group">
                <label>Product Keywords</label>
                <input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords"
                       value="{!! old('txtKeywords',$product->keywords) !!}"/>
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" rows="3"
                          name="txtDescription">{!! old('txtDescription',$product->description) !!}</textarea>
            </div>
            <button type="submit" class="btn btn-default">Product Edit</button>
            <button type="reset" class="btn btn-default">Reset</button>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-4">
            @foreach($productImages as $key => $productImage)
                <div class="form-group" id="hinh{!! $key !!}">
                    <a href="" class="btn btn-danger btn-circle icon_del"><i class="fa fa-times"></i></a>
                    <img src="{!! asset('resources/upload/detail/'.$productImage->image) !!}"
                         alt="{!! $productImage->image !!}"
                         class="img-responsive img-thumbnail img-thumbnail-detail" id="hinh{!! $key !!}">
                    <input type="file" name="fProductDetail[]" class="file">
                </div>
            @endforeach
            <button type="button" class="btn btn-primary" id="addImages">Add Image</button>
            <div id="insert"></div>
        </div>
        </div>
    </form>
@endsection