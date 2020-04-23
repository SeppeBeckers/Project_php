<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arrangement extends Model
{
    public function prices()
    {
        return $this->hasMany('App\Price', 'id');   // an arrangement has many prices
    }
}
