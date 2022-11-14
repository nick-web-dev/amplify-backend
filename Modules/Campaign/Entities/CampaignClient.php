<?php

namespace Modules\Campaign\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignClient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

}
