<?php

namespace Modules\Auth\Entities;

use Spatie\Permission\Models\Permission as SpatiePermission;


class Permission extends SpatiePermission
{
    protected $guarded = [];
}
