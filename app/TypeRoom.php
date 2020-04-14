<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    public function prices()
    {
        return $this->hasMany('App\Price', 'id');   // a typeRoom has many prices
    }

    public function rooms()
    {
        return $this->hasMany('App\Room', 'id');   // a typeRoom has many prices
    }

}
