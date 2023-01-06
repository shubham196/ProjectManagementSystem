<?php

namespace App\Models;


use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
class Project extends Model
{
    use HasFactory, FilterByTenant,HasRoles;

    protected $fillable = ['name','client_id','user_id','start_date','end_date','priority','attachments','description','status','files'];

    protected $casts = [
        'attachments' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
