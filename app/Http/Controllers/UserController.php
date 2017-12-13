<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\MessageBag;

use App\User;

class UserController extends Controller
{
    //
    public function getList(Request $request)
    {
        $users = User::all();
        return view('admin.user.list', ['users' => $users]);
    }

    public function getRegister()
    {

        return view('admin.user.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:32',
                'password_confirm' => 'required|same:password',
                'role' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa chọn bài học',
                'name.min' => 'Tên phải có ít nhất 3 ký tự',

                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Chưa nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',

                'password.required' => 'Chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max' => 'Mật khẩu không được quá 32 kí tự',

                'password_confirm.required' => 'Chưa nhập xác nhận mật khẩu',
                'password_confirm.sam' => 'Mật khẩu chưa khớp',

                'role.required' => 'Bạn chưa chọn quyền',
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;

        $user->save();

        return redirect('admin/user/list')->with('msg', 'Thêm mới tài khoản thành công');
    }

    public function getEdit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', ['user' => $user]);
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required|min:3',
            ],
            [
                'name.required' => 'Bạn chưa chọn bài học',
                'name.min' => 'Tên phải có ít nhất 3 ký tự',
            ]
        );
        $user = User::find($id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        if ($request->changePass == "on") {
            $this->validate($request,
                [
                    'password' => 'required|min:6|max:32',
                    'password_confirm' => 'required|same:password',
                ],
                [
                    'password.required' => 'Chưa nhập mật khẩu',
                    'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                    'password.max' => 'Mật khẩu không được quá 32 kí tự',

                    'password_confirm.required' => 'Chưa nhập xác nhận mật khẩu',
                    'password_confirm.sam' => 'Mật khẩu chưa khớp',
                ]
            );
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('admin/user/list')->with('msg', 'Sửa tài khoản thành công');
    }

    public function getDelete($id)
    {

    }

    public function getLoginAdmin()
    {
        return view('admin.login');
    }

    public function postLoginAdmin(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 3 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = $request->input('email');
            $password = $request->input('password');

            if (Auth::attempt(['email' => $email, 'password' => $password, 'role'=>'admin'])) {
                return redirect()->intended('admin/lesson/list');
            } else {
                $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }

    public function getLogoutAdmin()
    {
        Auth::logout();
        return redirect("admin/login");
    }
}
