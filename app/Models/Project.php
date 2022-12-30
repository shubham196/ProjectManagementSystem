<?php

namespace App\Models;

use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, FilterByTenant;

    protected $fillable = ['name','user_id','client_id','start_date','end_date','priority','leader','team','description','status','files'];


    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_owner');
    }
}
