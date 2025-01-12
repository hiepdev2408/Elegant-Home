<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\Mail\VerifyAccount;
use App\Models\Favourite;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;


class AccountController extends Controller
{
    const PATH_VIEW = 'client.auth.';
    public function showFormLogin()
    {
        return view(self::PATH_VIEW . 'login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',

        ], [

            'email.required' => 'email chưa nhập',
            'password.required' => 'Mật khẩu chưa nhập',

        ]);
        $data = $request->only('email', 'password');
        $check = auth('web')->attempt($data);
        if ($check) {
            if (auth('web')->user()->email_verified_at == '') {
                auth('web')->logout();
                return redirect()->back()->with('erorr', 'Tài khoản chưa được xác thực bằng email.Vui lòng kiểm tra tin nhắn Gmail');
            }
            return redirect()->route('home')->with('success', 'Đăng nhập tài khoản thành công !');
        }
        return redirect()->back()->with([
            'error' => 'Thông tin đăng nhập chưa chính xác. Vui lòng thử lại',
        ]);
    }
    public function showFormRegister()
    {
        return view(self::PATH_VIEW . 'register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address' => 'required|string',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ], [
            'name.required' => 'Họ và tên chưa nhập',
            'name.min' => 'Họ và tên cần trên 6 ký tự',
            'name.max' => 'Họ và tên không quá trên 100 ký tự',
            'email.required' => 'Email chưa nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Số điện thoại chưa nhập',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'address.required' => 'Địa chỉ chưa nhập',
            'address.string' => 'Địa chỉ không đúng định dạng',
            'password.required' => 'Mật khẩu chưa nhập',
            'password.min' => 'Mật khẩu cần trên 6 ký tự',
            'password_confirmation.required' => 'Xác nhận mật khẩu chưa nhập',
            'password_confirmation.same' => 'Xác nhận mật khẩu phải trùng với mật khẩu bên trên',
        ]);

        $user = $request->only(['name', 'email', 'phone', 'address']);
        $request['role_id'] = 3;
        $user['password'] = bcrypt($request->password);

        $acc = User::create($user);

        if ($acc) {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('login')->with('oke', 'Đăng ký thành công, vui lòng kiểm tra Gmail để xác nhận tài khoản');
        }

        return redirect()->back()->withErrors(['msg' => 'Có lỗi xảy ra trong quá trình đăng ký']);


    }
    public function veryfy($email)
    {
        $acc = User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('login')->with('ok', 'Xác nhận đăng ký thành công');
    }

    public function showFormForgotPassword()
    {
        return view('client.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }


    public function showFormReset($token)
    {
        return view('client.auth.passwords.reset')->with(['token' => $token]);
    }


    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );
        Log::info('Password reset request:', $request->all());

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Đổi mật khẩu thành công')
            : back()->withErrors(['email' => __($status)]);
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')
            ->with('success', 'Bạn đã đăng xuất. Chúc bạn một ngày tốt lành!');
    }
    // Favorite
    public function showFavorite()
    {
        $favorite = auth()->user()->favorites;

        return view('client.auth.favorite', compact('favorite'));
    }
    public function deleteFavorite($id)
    {

        $user_id = Auth::id();
        $favorite = Favourite::where('id', $id)
            ->where('user_id', $user_id)
            ->first();

        $favorite->delete();
        return back()->with('success', 'Thao tác thành công!');
    }
}
