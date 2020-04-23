<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arrangement extends Model
{
    public function prices()
    {
        return $this->hasMany('App\Price');   // an arrangement has many prices
    }
}
