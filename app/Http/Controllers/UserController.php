<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\User;
use Hash;

class UserController extends Controller
{
    public function getList()
    {
        $users = User::all();
        return view('admin.user.list')
        ->with('users',$users)
        ->with('i',1);
    }

    public function getAdd()
    {
        return view('admin.user.add');
    }

    public function postAdd(UserRequest $userRequest)
    {
        $user = new User;
        $user->username = $userRequest->txtUser;
        $user->password = Hash::make($userRequest->txtPass);
        $user->email = $userRequest->txtEmail;
        $user->level = $userRequest->rdoLevel;
        $user->remember_token = $userRequest->_token;
        $user->save();
        return redirect()->route('admin.user.getList')
            ->with(['level' => 'success', 'flash_message' => 'Thêm thành công!']);
    }

    public function getDelete($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.user.getList')
            ->with(['level' => 'success', 'flash_message' => 'Xóa thành công!']);
    }

    public function getEdit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit')
        ->with('user',$user);
    }

    public function postEdit(Request $request)
    {
        $this->validate($request,[
            'txtRePass'=>'same:txtPass',
            'txtEmail'=>'required'
            ]);
    }
}
