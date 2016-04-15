@extends('admin.master')
@section('controller','User')
@section('action','List')
@section('content')

    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th>ID</th>
            <th>Username</th>
            <th>Level</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr class="odd gradeX" align="center">
            <td>{!! $i++ !!}</td>
            <td>{!! $user->username !!}</td>
            <td>
                @if ($user->level == 0) {!! 'Super admin' !!}
                @elseif ($user->level == 1) {!! 'Admin' !!}
                @elseif ($user->level == 2) {!! 'Member' !!}
                @endif
            </td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirmDel('Bạn có chắc chắn xóa?')" href="{!! route('admin.user.getDelete',$user->id) !!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.user.getEdit',$user->id) !!}">Edit</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection
