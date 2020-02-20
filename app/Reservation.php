<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function bill()
    {
        return $this->belongsTo('App\Bill')->withDefault();   // a reservation belongs to a bill
    }
    public function roomReservations()
    {
        return $this->hasMany('App\RoomReservation');   // a reservation has many roomReservations
    }

}
