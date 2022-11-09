<?php

namespace Modules\Localization\Entities;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Socoladaica\LaravelTablePrefix\HasTablePrefix;

class Model extends EloquentModel
{
    use HasFactory, HasTablePrefix;



    protected $prefix = "LOCALIZATION_";
    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Localization\Database\factories\ModelFactory::new();
    }
}
