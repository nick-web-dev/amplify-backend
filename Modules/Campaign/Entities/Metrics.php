<?php

namespace Modules\Campaign\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metrics extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Campaign\Database\factories\MetricsFactory::new();
    }
}
