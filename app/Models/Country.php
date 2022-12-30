<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $fillable=[
        
        'name','nicename',
        'phonecode',
    ];

    public function states()
    {
        return $this->hasMany(State::class);
    }

}
