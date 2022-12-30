<?php

namespace App\Models;

use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, FilterByTenant;

    protected $fillable = ['name', 'project_id','user_id','team_id','task_description','start_date','end_date','priority','status','files'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_owner');
    }
}
