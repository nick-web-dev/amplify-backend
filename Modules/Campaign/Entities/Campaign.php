<?php

namespace Modules\Campaign\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    public function plan()
    {
        return $this->belongsTo(CampaignPlan::class, 'campaign_plan_id');
    }
    public function metrics()
    {
        return $this->hasMany(Metrics::class, 'campaign_id');
    }
    public function destinationUrls()
    {
        return $this->hasMany(DestinationUrl::class, 'campaign_id');
    }
    protected static function newFactory()
    {
        return \Modules\Campaign\Database\factories\CampaignFactory::new();
    }
}
