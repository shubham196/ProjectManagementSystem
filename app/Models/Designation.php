<?php

namespace App\Models;

use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Designation extends Model
{
    use HasFactory,FilterByTenant,HasRoles;

    protected $fillable = [
        'name',
        'department_id',
    ];


    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
