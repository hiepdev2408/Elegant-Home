<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    public function index()
    {
        $data = User::query()->get();
        return view('admin.users.index', compact('data'));
       
    }
  
    public function create()
    {
      
    }

   
    public function store(Request $request)
    {
        
    }

   
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
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
        
        $users = $request->except('avatar');
        
        $currentAvatar = 'user/' . $request->avatar;

        if($request->hasFile('avatar')){
            $users['avatar'] = Storage::put('users', $request->file('avatar'));
        }

        $user->update($users);

        if($currentAvatar && Storage::exists($currentAvatar)){
            Storage::delete($currentAvatar);
        }

        return redirect()->route('users.edit', $id)->with('success', 'Thông tin đã được cập nhật!');
    }    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('users.index');

        // Thêm thông báo thành công
        
    }
}
