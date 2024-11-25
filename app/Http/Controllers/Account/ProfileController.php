<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    const PATH_VIEW = 'client.auth.smember.';
    public function profile()
    {
        $user = Auth::user();
        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    public function order()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function endow()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function info()
    {
        return view('client.auth.smember.info');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        //     'phone' => 'nullable|string|max:15',
        //     'address' => 'nullable|string|max:255',
        //     'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $auth = $request->except('avatar');

        $currentAvatar = 'user/' . $request->avatar;

        if ($request->hasFile('avatar')) {
            $auth['avatar'] = Storage::put('user', $request->file('avatar'));
        }
        $user->update($auth);

        if ($currentAvatar && Storage::exists($currentAvatar)) {
            Storage::delete($currentAvatar);
        }
        return redirect()->back()->with('success', 'Thông tin đã được cập nhật!');
    }
}


