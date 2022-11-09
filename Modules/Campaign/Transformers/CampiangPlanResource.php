<?php

namespace Modules\Campaign\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CampiangPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
