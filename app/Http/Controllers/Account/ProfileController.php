<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('client.auth.account.profile', compact('user'));
    }

    public function order()
    {
        return view('client.auth.account.order');
    }
    public function show($id)
    {
        $user = Auth::user();
        return view('client.auth.account.show', compact('user'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('client.auth.account.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
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

        return redirect()->route('profile.edit', $id)->with('success', 'Thông tin đã được cập nhật!');
    }
}


