<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Modules\Auth\Entities\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $modules = \Module::toCollection()->toArray();
        foreach ($modules as $module) {
            $path = $module['path'] . DIRECTORY_SEPARATOR . 'Permissions' . DIRECTORY_SEPARATOR . 'permissions.php';
            if (File::exists($path)) {
                $this->seedPermissions($path);
            }
        }
    }
    public function seedPermissions($path)
    {
        $permissions = require $path;

        foreach ($permissions as $permission) {

            $name = Arr::get($permission, 'name', null);
            $guards = Arr::get($permission, 'guards', ['admin']);
            if (!is_array($guards)) {
                $guards = explode($guards, ',');
            }

            foreach ($guards as $guard) {
                $permission = $this->createPemrission($name, $guard);
            }
        }
    }
    public function createPemrission($name, $guard = 'admin'): Permission
    {
        $permission = Permission::firstOrCreate([
            'name' => $name,
            'guard_name' => $guard
        ]);
        return $permission;
    }
}
