<?php

namespace Modules\Linquer\Entities;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;
use Modules\Linquer\Policies\TaskPolicy;

class Task extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $fillable = [];

    public function filters()
    {
        return [];
    }
    public function sorts()
    {
        return [];
    }
    public static function boot()
    {
        Gate::policy(Task::class, TaskPolicy::class);

        parent::boot();
    }
    protected static function newFactory()
    {
        return \Modules\Linquer\Database\factories\TaskFactory::new();
    }
}
