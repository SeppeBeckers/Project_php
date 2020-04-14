<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccommodationChoice extends Model
{
    public function prices()
    {
        return $this->hasMany('App\Price', 'id');   // an accommodationChoice has many prices
    }
}
