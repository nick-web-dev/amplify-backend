<?php

namespace Modules\Linquer\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Socoladaica\LaravelTablePrefix\HasTablePrefix;

class Model extends Eloquent
{
    use HasFactory, HasTablePrefix;

    protected $guarded = [];
    protected $prefix = "LINQUER_";


    protected static function newFactory()
    {
        return \Modules\Linquer\Database\factories\ModelFactory::new();
    }
}
