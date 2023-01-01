<?php

namespace App\Models;

use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory,FilterByTenant;

    protected $fillable = ['tenant_id', 'email', 'token', 'accepted_at'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
