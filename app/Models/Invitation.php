<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Invitation extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = ['tenant_id', 'email', 'token', 'accepted_at'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
