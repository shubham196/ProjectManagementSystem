<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
trait FilterByFilamentUser {

    public static function boot()
    {
        parent::boot();

        $currentTenantID = auth()->user()->current_tenant_id;

        self::addGlobalScope(function(Builder $builder) use ($currentTenantID) {
            $builder->where('current_tenant_id', $currentTenantID);
        });

        
     
    }

}
