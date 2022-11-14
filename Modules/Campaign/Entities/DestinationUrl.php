<?php

namespace Modules\Campaign\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;
use Modules\Campaign\Observers\DestinationUrlObserver;
use Modules\Campaign\Policies\DestinationUrlPolicy;

class DestinationUrl extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    public static function boot()
    {
        parent::boot();
        static::observe(DestinationUrlObserver::class);
        Gate::policy(DestinationUrl::class, DestinationUrlPolicy::class);
    }
    protected static function newFactory()
    {
        return \Modules\Campaign\Database\factories\DestinationUrlFactory::new();
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
