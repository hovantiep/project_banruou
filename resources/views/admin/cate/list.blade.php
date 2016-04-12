@extends('admin.master')
@section('controller','Category')
@section('action','List')
@section('content')
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Category Parent</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cates as $cate)
            <tr class="odd gradeX" align="center">
                <td>{{ $i++ }}</td>
                <td>{{ $cate->name }}</td>
                <td>
                    @if($cate->parent_id == 0)
                        {{ "None" }}
                    @else
                        {{ DB::table('cates')->select('name')->where('id',$cate->parent_id)->first()->name  }}
                    @endif
                </td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirmDel('Có chắc chắn xóa không?')"
                            href="{!! route('admin.cate.getDelete',$cate->id) !!}"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                            href="{!! route('admin.cate.getEdit',$cate->id) !!}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection