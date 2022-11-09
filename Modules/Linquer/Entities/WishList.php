<?php

namespace Modules\Linquer\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class WishList extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Linquer\Database\factories\WishListFactory::new();
    }
}
