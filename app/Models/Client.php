<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

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
