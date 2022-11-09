<?php

namespace Modules\Campaign\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\DestinationUrl;

class DestinationUrlPolicy
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
    public function viewAny(User $user)
    {
        //


    }
    public function view(User $user, DestinationUrl $url)
    {
        //
    }
    public function create(User $user, Campaign $campaign)
    {
        //

        if ($campaign->destinationUrls()->count() >= $campaign->plan->max_number_of_destination_urls) {
            Response::deny("Maximum Number of Destination Urls Exceed");
        }
        return true;
    }
    public function update(User $user, DestinationUrl $url)
    {
        //
    }
    public function delete(User $user, DestinationUrl $url)
    {
        //
    }
    public function restore(User $user, DestinationUrl $url)
    {
        //
    }

    public function forceDelete(User $user, DestinationUrl $url)
    {
        //
    }
}
