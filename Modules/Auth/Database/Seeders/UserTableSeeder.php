<?php

namespace Modules\Auth\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $admin = User::firstOrCreate([
            'name' => 'Kevin',
            'email' => 'admin@purelinq.com'
        ], [
            'password' => bcrypt('1234admin'),

        ]);
        $admin->assignRole(['Super Admin']);
    }
}
