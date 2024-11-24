<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::query()->with(['users'])->get();
        $roleProduct = Permission::whereIn('slug', ['products.index', 'products.create', 'products.edit'])->get();
        return view('admin.roles.index', compact('roles', 'roleProduct'));
    }
}
