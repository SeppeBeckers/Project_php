<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupancy extends Model
{
    public function prices()
    {
        return $this->hasMany('App\Price');   // an occupancy has many prices
    }
}
