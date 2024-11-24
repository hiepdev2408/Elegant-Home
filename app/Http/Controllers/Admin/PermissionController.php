<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use TraitCRUD;

    const OBJECT = 'permissions';

    public function __construct(
        protected Permission $model
    ) {
    }

    public function access(Role $role, string $id)
    {
        $permissions = Permission::query()->with(['roles'])->get();
        $role = Role::query()->findOrFail($id);
        $roleProduct = Permission::whereIn('slug', ['products.index', 'products.create', 'products.edit'])->get();
        return view('admin.roles.grant', compact('permissions', 'role', 'roleProduct'));
    }

    public function updateGant(Request $request)
    {
        // dd($request->all());

        foreach ($request->permissions as $roleId => $permissionIds) {
            $role = Role::find($roleId);
            // Đồng bộ quyền đã chọn với role (sẽ xóa quyền cũ nếu không được chọn)
            $role->permissions()->sync($permissionIds);

        }
        return redirect()->back()->with('success', 'Cập nhật quyền thành công!');
    }
}
