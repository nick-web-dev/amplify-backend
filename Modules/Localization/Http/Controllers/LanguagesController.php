<?php

namespace Modules\Localization\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;


class LanguagesController extends Controller
{


    public function languageFiles($lang)
    {

        $lang = \Str::lower($lang);
        \Cache::forget('lang-' . $lang . '.js');
        $strings = \Cache::remember('lang-{$lang}.js', 0, function () use ($lang) {

            $pagesDirectory = resource_path('lang/' . $lang . '/pages');

            if (config('app.env') == 'local') {

                $pagesDirectory = resource_path('langMain/en/pages');
            }

            if (!File::exists($pagesDirectory)) {
                abort(404);
            }
            $strings = $this->getLanguageFilesFromDirectory($pagesDirectory);
            return $strings;
        });

        return $strings;
    }
    public function getLanguageFilesFromDirectory($directory)
    {
        $strings = [];
        $files   = glob($directory . '/*.php');
        $folders = glob($directory . '/*', GLOB_ONLYDIR);
        foreach ($files as $file) {
            $name   = basename($file, '.php');
            if ($name != 'index') {
                // dd('here', $name);
                $strings[$name] = require $file;
            } else {
                $strings = array_merge(require $file, $strings);
            }
        }
        foreach ($folders as $folder) {
            $folderName   = basename($folder);
            $strings[$folderName] = $this->getLanguageFilesFromDirectory($folder);
        }
        return $strings;
    }
}
