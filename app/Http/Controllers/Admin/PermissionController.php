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
        $role = Role::findOrFail($id);

        // Group permissions by type to reduce queries
        $permissions = Permission::whereIn('slug', [
            'products.index',
            'products.create',
            'products.edit',
            'categories.index',
            'categories.create',
            'categories.edit',
            'attributes.index',
            'attributes.create',
            'attributes.edit',
            'attribute_values.index',
            'attribute_values.create',
            'attribute_values.edit',
            'permissions.index',
            'permissions.create',
            'permissions.edit',
            'vouchers.index',
            'vouchers.create',
            'vouchers.edit',
            'sales.index',
            'sales.create',
            'sales.edit',
            'blogs.index',
            'blogs.create',
            'blogs.edit',
        ])->get()->groupBy(function ($permission) {
            if (str_contains($permission->slug, 'products')) {
                return 'roleProduct';
            } elseif (str_contains($permission->slug, 'categories')) {
                return 'roleCategory';
            } elseif (str_contains($permission->slug, 'attributes')) {
                return 'roleAttribute';
            } elseif (str_contains($permission->slug, 'attribute_values')) {
                return 'roleAttributeValue';
            } elseif (str_contains($permission->slug, 'permissions')) {
                return 'rolePermission';
            } elseif (str_contains($permission->slug, 'vouchers')) {
                return 'roleVouchers';
            } elseif (str_contains($permission->slug, 'sales')) {
                return 'roleSales';
            } elseif (str_contains($permission->slug, 'blogs')) {
                return 'roleBlogs';
            }
        });

        // Pass grouped permissions to the view
        return view('admin.roles.grant', [
            'role' => $role,
            'roleProduct' => $permissions->get('roleProduct') ?? collect(),
            'roleCategory' => $permissions->get('roleCategory') ?? collect(),
            'roleAttribute' => $permissions->get('roleAttribute') ?? collect(),
            'roleAttribute_value' => $permissions->get('roleAttributeValue') ?? collect(),
            'rolePermission' => $permissions->get('rolePermission') ?? collect(),
            'roleVouchers' => $permissions->get('roleVouchers') ?? collect(),
            'roleSales' => $permissions->get('roleSales') ?? collect(),
            'roleBlogs' => $permissions->get('roleBlogs') ?? collect(),
        ]);
    }


    public function updateGant(Request $request)
    {
        // dd($request->all());
        if (!empty($request->permissions)) {
            foreach ($request->permissions as $roleId => $permissionIds) {
                $role = Role::find($roleId);

                if ($role) {
                    // Đồng bộ quyền đã chọn với role (sẽ xóa quyền cũ nếu không được chọn)
                    $role->permissions()->sync($permissionIds);
                }
            }
        } else {
            // Trường hợp không có quyền nào được chọn
            return back()->with('errors', 'Không có quyền nào được chọn.');
        }


        return redirect()->back()->with('success', 'Cập nhật quyền thành công!');
    }
}
