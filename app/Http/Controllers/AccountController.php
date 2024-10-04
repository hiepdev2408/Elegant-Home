<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

class AccountController extends Controller
{
    public function login()
    {
        return view('client.auth.login');
    }
    public function check_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|',

        ], [

            'email.required' => 'email chưa nhập',
            'password.required' => 'Mật khẩu chưa nhập',
            'password.min' => 'Họ và tên cần trên 6 ký tự',





        ]);
        $data = request()->all('email', 'password');
        if (auth()->attempt($data)) {
            return view('client.home');
        }
        return redirect()->back()->with([
            'messageError' => 'Email đăng nhập hoặc mật khẩu sai',
        ]);
    }
    public function register()
    {
        return view('client.auth.register');
    }
    public function check_register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address' => 'required|string',
            'password' => 'required|min:6|',
            'config_password' => 'required|same:password',

        ], [
            'name.required' => 'Họ và tên chưa nhập',
            'name.min' => 'Họ và tên cần trên 6 ký tự',
            'name.max' => 'Họ và tên không quá trên 100 ký tự',
            'email.required' => 'email chưa nhập',
            'email.email' => 'email không đúng định dạng',
            'phone.required' => 'Số điện thoại chưa nhập',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'address.required' => 'Địa chỉ chưa nhập',
            'address.string' => 'Địa chỉ không đúng định dạng',
            'password.required' => 'Mật khẩu chưa nhập',
            'password.min' => 'Họ và tên cần trên 6 ký tự',
            'config_password.required' => 'Xác nhận mật khẩu chưa nhập',
            'config_password.same' => 'Xác nhận mật khẩu phải trùng với mật khẩu bên trên',




        ]);
        $user = $request->only(['name', 'email', 'phone', 'address']);
        $user['password'] = bcrypt($request->password);
        if ($acc = User::create($user)) {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('login')->with(' đăng ký thành công');
        }
    }
    public function veryfy($email)
    {
        $acc = User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('login')->with('Xác nhận đăng ký thành công');
    }
}
