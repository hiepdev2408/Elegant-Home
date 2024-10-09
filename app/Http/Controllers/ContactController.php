<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('client.contact');
    }
    public function contact_check(Request $request)
    {
           $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'phone_number'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email'=>'required|email',
            'message'=>'required',
           ]);
        $data = $request->only(['first_name','last_name','email','phone_number','message']);
        if(Contract::create($data)){
            return redirect()->route('contact')->with([
             'success'=>'Bạn đã liên hệ thành công,chúng tôi sẽ cố gắng phản hồi sớm nhất qua gmail cho bạn.'
            ]);
        }

    }
}
