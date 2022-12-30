<?php

namespace App\Models;
use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Employee extends Model
{
    use HasFactory, FilterByTenant;

 protected $fillable = 
 ['user_id','name','department_id','designation_id',
 'profile_photo','company','mobile_no','join_date'
 ];



 public function user()
{
    return $this->belongsTo(User::class);
}
public function department()
{
    return $this->belongsTo(Department::class);
}
public function designation()
{
    return $this->belongsTo(Designation::class);
}

}

