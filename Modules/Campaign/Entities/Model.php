<?php

namespace Modules\Campaign\Entities;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Socoladaica\LaravelTablePrefix\HasTablePrefix;

class Model extends EloquentModel
{
    use HasFactory, HasTablePrefix;
    protected $prefix = "CAMPAIGN_";
    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Campaign\Database\factories\ModelFactory::new();
    }
}
