<?php

namespace Modules\Localization\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Localization\Database\factories\LanguageFactory::new();
    }
}
