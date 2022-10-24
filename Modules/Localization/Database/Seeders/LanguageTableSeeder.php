<?php

namespace Modules\Localization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Modules\Localization\Entities\Language;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $languages = [

            [
                'name' => 'English',
                'shortcut' => 'en',
            ],
        ];
        if (!File::exists(resource_path('lang'))) {
            File::makeDirectory(resource_path('lang'));
        }

        foreach ($languages as $language) {


            $lang = Language::updateOrCreate($language, $language);
        }



        // $this->call("OthersTableSeeder");
    }
}
