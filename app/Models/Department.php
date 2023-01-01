<?php

namespace App\Models;
use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Department extends Model
{
    use HasFactory,FilterByTenant,HasRoles;


    protected $fillable = [
        'name'
    ];
}
