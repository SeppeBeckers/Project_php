<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    public function prices()
    {
        return $this->hasMany('App\Price');   // a typeRoom has many prices
    }

}
