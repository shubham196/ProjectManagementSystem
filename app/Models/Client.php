<?php

namespace App\Models;

use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Client extends Model
{
    use HasFactory,FilterByTenant,HasRoles;

    protected $fillable = [
        'firstname','lastname','email','country_id','state_id','size','verticle','phone','company','avatar'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function states(){
        return $this->belongsTo(State::class);
    }

}
