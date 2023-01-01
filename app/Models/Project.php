<?php

namespace App\Models;

use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Project extends Model
{
    use HasFactory, FilterByTenant,HasRoles;

    protected $fillable = ['name','client_id','user_id','start_date','end_date','priority','team','description','status','files'];

    protected $casts = [
        'team' => 'array',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
