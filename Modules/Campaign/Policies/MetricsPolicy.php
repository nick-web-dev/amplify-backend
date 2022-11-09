<?php

namespace Modules\Campaign\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\Metrics;

class MetricsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //


    }
    public function view(User $user, Metrics $metrics)
    {
        //
    }
    public function create(User $user, Campaign $campaign)
    {
        //
        $currentMetricsCount = $campaign->metrics()->count();
        $allowedMetricsCount = $campaign->plan->max_number_of_metrics;
        if ($currentMetricsCount >= $allowedMetricsCount) {
            return false;
        }
    }
    public function update(User $user, Metrics $metrics)
    {
        //
    }
    public function delete(User $user, Metrics $metrics)
    {
        //
    }
    public function restore(User $user, Metrics $metrics)
    {
        //
    }

    public function forceDelete(User $user, Metrics $metrics)
    {
        //
    }
}
