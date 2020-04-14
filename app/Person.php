<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function roomReservation()
    {
        return $this->belongsTo('App\Reservation', 'reservation_id')->withDefault();   // a person belongs to a roomReservation
    }
    public function age()
    {
        return $this->belongsTo('App\Age', 'age_id')->withDefault();   // a person belongs to a age
    }
}
