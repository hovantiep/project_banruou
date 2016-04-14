@extends('admin.master')
@section('controller','Product')
@section('action','List')
@section('content')

    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Date</th>
            <th>Category</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $prod)
            <tr class="odd gradeX" align="center">
                <td>{!! $i++ !!}</td>
                <td>{!! $prod->name !!}</td>
                <td align="right">{!! number_format($prod->price,0,',','.') !!} VNĐ</td>
                <td>{!! Carbon\Carbon::createFromTimestamp(strtotime($prod->created_at))->diffForHumans() !!}</td>
                <td>{{ \App\Product::find($prod->id)->cate->name }}</td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                            onclick="return confirmDel('Bạn có chắc chắn xóa')"
                            href="{!! route('admin.product.getDelete',$prod->id) !!}"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                            href="{!! route('admin.product.getEdit',$prod->id) !!}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>



@endsection