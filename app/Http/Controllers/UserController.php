<?php

namespace project1\Http\Controllers;

use project1\Http\Requests;
use project1\Http\Requests\UserRequest;
use project1\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getList()
    {
        $users = User::all();
        return view('admin.user.list')
            ->with('users', $users)
            ->with('i', 1);
    }

    public function getAdd()
    {
        return view('admin.user.add');
    }

    public function postAdd(UserRequest $userRequest)
    {
        // Kiểm tra quyền mới được thêm thành viên (chưa làm)
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
        // super = 0    admin = 1   user = 2
        $current_user = \Auth::user();
        $user = User::find($id);
        if ($user->level == 0 || $user->id == $current_user->id || ($user->level != 0 && $current_user->level >= $user->level)) {
            return redirect()->route('admin.user.getList')
                ->with(['level' => 'danger', 'flash_message' => 'Bạn không có quyền xóa user này!']);
        } else {
            $user->delete();
            return redirect()->route('admin.user.getList')
                ->with(['level' => 'success', 'flash_message' => 'Xóa thành công!']);
        }
    }

    public function getEdit($id)
    {
        // Cấm:
        // 1. admin thường sửa super
        // 2. admin thường sửa admin không là của chính mình
        // 3. member
        // 4. super sửa của người khác mình
        // => super admin sửa hết, admin sửa của mình, member không được sửa, cùng cấp không sửa được
        $user = User::find($id);
        $current_user = \Auth::user();
        if (($current_user->level == 1 && $user->level == 0) ||
            ($current_user->level == 1 && $current_user->id != $user->id && $user->level == 1) ||
            ($current_user->level == 2) ||
            ($current_user->level == 0 && $current_user->id != $user->id)
        ) {
            return redirect()->route('admin.user.getList')
                ->with(['level' => 'danger', 'flash_message' => 'Bạn không có quyền sửa user này!']);
        } else {
            return view('admin.user.edit')
                ->with('user', $user);
        }

    }

    public function postEdit($id, Request $request)
    {

        $user = User::find($id);
        if ($request->input('txtPass')) {
            $this->validate($request,
                [
                    'txtRePass' => 'required|same:txtPass',
                ],
                [
                    'txtRePass.required' => 'Chưa xác nhận mật khẩu',
                    'txtRePass.same' => 'Xác nhận mật khẩu sai',
                ]);
            $user->password = Hash::make($request->input('txtPass'));
        }
        $this->validate($request,
            [
                'txtEmail' => 'required|email'
            ],
            [
                'txtEmail.required' => 'Chưa điền email',
                'txtEmail.email' => 'Đây không phải là email',
            ]);
        $user->email = $request->txtEmail;
        $user->level = $request->rdoLevel;
        $user->remember_token = $request->_token;
        $user->save();
        return redirect()->route('admin.user.getList')
            ->with(['level' => 'success', 'flash_message' => 'Sửa thành công!']);
    }
}
