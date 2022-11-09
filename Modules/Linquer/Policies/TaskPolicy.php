<?php

namespace Modules\Linquer\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Linquer\Entities\Task;

class TaskPolicy
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
    public function view(User $user, Task $task)
    {
        //
    }
    public function create(User $user)
    {
        //
    }
    public function update(User $user, Task $task)
    {
        //
    }
    public function delete(User $user, Task $task)
    {
        //
    }
    public function restore(User $user, Task $task)
    {
        //
    }

    public function forceDelete(User $user, Task $task)
    {
        //
    }
}
