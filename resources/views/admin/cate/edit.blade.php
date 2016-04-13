@extends('admin.master')
@section('controller','Category')
@section('action','Edit')
@section('content')

    <div class="col-lg-7" style="padding-bottom:120px">
        @include('admin.block.vali_msg')
        <form action="{!! route('admin.cate.postEdit',$cate->id) !!}" method="POST">
            <div class="form-group">
                <label>Category Parent</label>
                <select class="form-control" name="sltCate">
                    <option value="0">Please Choose Category</option>
                    <?php cate_parent($parent, 0, "", $cate->parent_id) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Category Name</label>
                <input class="form-control" name="txtCateName" placeholder="Please Enter Category Name"
                       value="{!! old('txtCateName',$cate->name) !!}"/>
            </div>
            <div class="form-group">
                <label>Category Order</label>
                <input class="form-control" name="txtOrder" placeholder="Please Enter Category Order"
                       value="{!! old('txtOrder',$cate->order) !!}"/>
            </div>
            <div class="form-group">
                <label>Category Keywords</label>
                <input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords"
                       value="{!! old('txtKeywords',$cate->keywords) !!}"/>
            </div>
            <div class="form-group">
                <label>Category Description</label>
                <textarea class="form-control" rows="3"
                          name="txtDescription">{!! old('txtDescription',$cate->description) !!}</textarea>
            </div>
            <button type="submit" class="btn btn-default">Category Edit</button>
            <button type="reset" class="btn btn-default">Reset</button>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </form>
    </div>

@endsection