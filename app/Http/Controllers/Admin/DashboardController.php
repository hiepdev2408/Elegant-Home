<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // dd($countContact);
        return view('admin.dashboard');
    }

    public function compose(View $view)
    {
        $countContact = Contract::count();
        $view->with('countContact', $countContact);
    }
}
