<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Helpers\Mail\ContactFormMail;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function index()
    {
        $totalCart = getCartItemCount();

        $data = Contract::query()->get();
        return view('admin.contacts.index', compact('data', $totalCart));
    }
    public function contact()
    {
        $totalCart = getCartItemCount();
        return view('client.emails.contact', compact('totalCart'));
    }
    public function submit(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ], [
            'first_name.required' => 'Vui lòng nhập tên.',
            'last_name.required' => 'Vui lòng nhập họ.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'message.required' => 'Vui lòng nhập tin nhắn.',
        ]);
        Contract::query()->create($validatedData);
        // gửi tới mail quản trị
        Mail::to('hoanganhtq2020@gmail.com')->send(new ContactFormMail($validatedData));

        return redirect()->back()->with('success', 'Tin nhắn của bạn đã được gửi thành công!');
    }

    public function destroy(string $id)
    {
        $data = Contract::query()->findOrFail($id);
        $data->delete();
        return back()->with('success', 'Xóa thành công');
    }
}
