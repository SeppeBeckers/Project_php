<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function billCosts()
    {
        return $this->hasMany('App\BillCost');   // a bill has many billCosts
    }
    public function reservation()
    {
        return $this->belongsTo('App\Reservation')->withDefault();   // a bill belongs to a reservation
    }
}
