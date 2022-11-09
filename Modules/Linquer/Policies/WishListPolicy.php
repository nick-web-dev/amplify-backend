<?php

namespace Modules\Linquer\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class WishListPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
