<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\MessageBag;

use App\User;
use Mail;

class UserController extends Controller
{
    //
    var $email;
    var $code_active;
    public function getList(Request $request)
    {
        $search_email = $request->search;
        if(!empty($search_email)) {
            $users = User::where('email','Like', '%' . $search_email . '%')->paginate(10);
        }else{
            $users = User::paginate(10);
        }
        $users->withPath('admin/user/list');
        return view('admin.user.list', ['users' => $users, 'search_email'=>$search_email]);
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
        $this->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $this->code_active =  $user->code_active = str_random(16);
        $user->active = false;
        Mail::send('email.active_account', ['name'=>$request->name , 'pass'=> $this->code_active, 'mail'=> $this->email ], function($msg){
            $msg->to($this->email)->subject('Xác nhận tài khoản');
        } );
        $user->save();
        return redirect('admin/login')->with('msg', 'Chúng tôi đã gửi đường dẫn kích hoạt vào tài khoản của bạn. Vui lòng vào mail để xác nhận');
    }

    public function getActive($password){
        $user = User::where('code_active', $password)->update(['active' => true ]);
        return redirect('admin/login');
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

            if (Auth::attempt(['email' => $email, 'password' => $password, 'role'=>'admin', 'active' => true])) {
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
