<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Modules\Auth\Database\Seeders\AuthDatabaseSeeder;
use Modules\Auth\Database\Seeders\PermissionTableSeeder;
use Modules\Auth\Database\Seeders\RoleTableSeeder;
use Modules\Auth\Database\Seeders\UserTableSeeder;
use Modules\Localization\Database\Seeders\LanguageTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // generate main languages
        Artisan::call('check:translation');

        $this->call(LanguageTableSeeder::class);

        $this->call(AuthDatabaseSeeder::class);

        \Artisan::call('passport:install --force');
    }
}
