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
    ) {}

    public function gant()
    {
        $permissions = Permission::query()->with(['roles'])->get();
        $roles = Role::all();

        return view('admin.roles.grant', compact('permissions', 'roles'));
    }

    public function updateGant(Request $request)
    {
        foreach ($request->permissions as $roleId => $permissionIds) {
            $role = Role::find($roleId);

            if ($role) {
                // Lọc chỉ các quyền có giá trị '1' (đã chọn)
                $selectedPermissions = array_keys(array_filter($permissionIds, function ($value) {
                    return $value == 1;
                }));

                // Đồng bộ quyền đã chọn với role
                $role->permissions()->sync($selectedPermissions);
            }
        }

        return redirect()->back()->with('success', 'Cập nhật quyền thành công!');
    }
}
