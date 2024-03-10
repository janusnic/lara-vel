<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Carbon\Carbon;

class AncientScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // $builder->where('created_at', '<', Carbon::now()->subMonth());
        $builder->where('created_at', '<', Carbon::now()->subDays(1));
    }
}
