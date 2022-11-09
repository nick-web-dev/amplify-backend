<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Entities\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $permissions = Permission::where('guard_name', 'admin')->get()->pluck('id');

        // super admin role
        $superAdmin = Role::firstOrCreate(['guard_name' => 'admin', 'name' => "Super Admin", 'is_system' => 1]);
        $superAdmin->givePermissionTo($permissions->toArray());
    }
}
