<?php

namespace Modules\Campaign\Observers;

use Modules\Campaign\Entities\DestinationUrl;
use Modules\Linquer\Http\Controllers\TasksController;

class DestinationUrlObserver
{

    public function created(DestinationUrl $url)
    {
        //

        if ($url->status === 'approved') {
            $this->createUrlTask($url);
        }
    }


    public function updated(DestinationUrl $url)
    {
        //

    }
    public function createUrlTask(DestinationUrl $url)
    {
        $taskController = new TasksController();
        $taskController->store($url);
    }

    public function deleted(DestinationUrl $url)
    {
        //
    }


    public function restored(DestinationUrl $url)
    {
        //
    }


    public function forceDeleted(DestinationUrl $url)
    {
        //
    }

    public function statusChanged(DestinationUrl $url)
    {
    }
}
