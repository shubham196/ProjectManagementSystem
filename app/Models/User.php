<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

 
    protected $fillable = [
        'name',
        'email',
        'password',
        'current_tenant_id',
        'project_id',
       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        
    ];
 
    public function tenants()
    {
        return $this->belongsToMany(Tenant::class)
                    ->where('user_id', auth()->id())
                    ->withPivot('is_owner');
    }
    public function project()
    {
        return $this->belongsToMany(Project::class);
        
    }
    public function task()
    {
        return $this->belongsToMany(Task::class);
        
    }


    public function employee()
    {
        return $this->belongsToMany(Employee::class)
                    ->where('user_id', auth()->id());
    }
}