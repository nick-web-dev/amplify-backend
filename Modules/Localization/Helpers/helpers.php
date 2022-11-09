<?php

use Modules\Localization\Entities\Language;

// Get Current User Locale

if (!function_exists('language')) {
    function language()
    {
        return request()->header('Content-Language') ? \Str::lower(request()->header('Content-Language')) : 'en';
    }
}

if (!function_exists('languages')) {
    function languages()
    {
        return Language::all();
    }
}


if (!function_exists('abortJson')) {
    function abortJson($errorBody = ['message' => 'Not Found'], $status = 404)
    {
        abort(response()->json($errorBody, $status));
    }
}
