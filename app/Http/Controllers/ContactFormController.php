<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function contact()
    {
        return view('client.emails.contact');
    }
    public function submit(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ], [
            'firstname.required' => 'Vui lòng nhập tên.',
            'lastname.required' => 'Vui lòng nhập họ.',
            'number.required' => 'Vui lòng nhập số điện thoại.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'message.required' => 'Vui lòng nhập tin nhắn.',
        ]);

        // gửi tới mail quản trị
        Mail::to('hoanganhtq2020@gmail.com')->send(new ContactFormMail($validatedData));

        return redirect()->back()->with('success', 'Tin nhắn của bạn đã được gửi thành công!');
    }
}
