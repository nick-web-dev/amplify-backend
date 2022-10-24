<?php

use Modules\Localization\Entities\Language;

// Get Current User Locale

function language()
{

    return request()->header('Content-Language') ? \Str::lower(request()->header('Content-Language')) : 'en';
}

function languages()
{
    return Language::all();
}


function abortJson($errorBody = ['message' => 'Not Found'], $status = 404)
{
    abort(response()->json($errorBody, $status));
}
