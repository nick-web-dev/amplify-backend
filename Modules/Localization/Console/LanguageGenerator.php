<?php

namespace Modules\Localization\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class LanguageGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:translation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will check translation files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $mainDirectory = resource_path('langMain/en');
        $mainDirectoryFiles = $this->getFilesList($mainDirectory);
        $languages = languages()->toArray();

        foreach ($languages as $language) {
            $languagePath = resource_path('lang/' . $language['shortcut']);
            $this->checkForLanuage($languagePath, $mainDirectoryFiles, $mainDirectory);
        }
        $this->info('Checking Translation Done');
    }

    public function checkForLanuage($directory, $files, $mainDirectory)
    {
        if (!File::exists($directory)) {
            File::makeDirectory($directory);
        }
        foreach ($files as $file => $directoryFiles) {

            $this->makeFile($directory . '/' . $file, $mainDirectory . '/' . $file);
            if (gettype($directoryFiles) == 'array') {
                $this->checkForLanuage($directory  . $file, $directoryFiles, $mainDirectory  . $file);
            } else {
                $this->transFile($mainDirectory . $file, $directory . $file);
            }
        }
    }
    public function transFile($mainPath, $translatedPath)
    {
        $this->info('checking ' . $translatedPath . ' ....');
        if (!is_dir($mainPath)) {
            $mainWords = require $mainPath;

            $otherWords = require $translatedPath;
            $otherWords = $this->translateArray($mainWords, $otherWords);

            $this->UpdateFile($translatedPath, $otherWords);
            $this->info('File : ' . $translatedPath . '. Had been translated succesfully');
        }
    }
    public function translateArray($mainWords, $otherWords)
    {
        $languages = languages();

        foreach ($mainWords as $key => $word) {
            if (strpos($key, '{lang}' . '') !== false) {

                foreach ($languages as $language) {
                    $langKey = str_replace('{lang}', $language->shortcut, $key);

                    if (!array_key_exists($langKey, $otherWords) || gettype($mainWords[$key]) != gettype($otherWords[$langKey])) {
                        $otherWords[$langKey] = str_replace('{lang_name}', $language->name, $mainWords[$key]);
                    }
                    if (is_array($mainWords[$key])) {
                        $otherWords[$langKey] = $this->translateArray($mainWords[$key], $otherWords[$langKey]);
                    } else {
                        if (!isset($otherWords[$langKey])) {
                            $otherWords[$langKey] = str_replace('{lang_name}', $language->name, $mainWords[$key]);
                        }
                    }
                }

                if (array_key_exists($key, $otherWords)) {
                    unset($otherWords[$key]);
                }
            } else {

                if (!array_key_exists($key, $otherWords) || gettype($mainWords[$key]) != gettype($otherWords[$key])) {
                    $otherWords[$key] = $mainWords[$key];
                }
                if (is_array($mainWords[$key])) {
                    $otherWords[$key] = $this->translateArray($mainWords[$key], $otherWords[$key]);
                } else {
                    if (!isset($otherWords[$key])) {
                        $otherWords[$key] = $mainWords[$key];
                    }
                }
            }
        }
        return $otherWords;
    }
    public function makeFile($file, $mainFile)
    {

        if (!File::exists($file)) {
            if (pathinfo($file, PATHINFO_EXTENSION) == "") {
                File::copyDirectory($mainFile, $file);
            } else {

                File::copy($mainFile, $file);
            }
        }
    }
    public function UpdateFile($fullPath, $content)
    {
        $content = '<?php return ' . var_export($content, true) . ';';

        File::put($fullPath, $content);
    }
    public function getFiles($langPath)
    {
        $files   = glob($langPath . '/*');
        return $files;
    }
    public function getFilesList($path)
    {
        $FilesList = [];





        $files = $this->getFiles($path);
        foreach ($files as $file) {
            $fileName = preg_replace('/^' . preg_quote($path, '/') . '/', '', $file);
            if (!isset($FilesList[$fileName])) {
                $FilesList[$fileName] = [];
            }
            $FilesList[$fileName] = true;

            if (is_dir($file)) {
                $FilesList[$fileName] = $this->getFilesList($file);
            }
        }

        return $FilesList;
    }
}
