<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function roomReservations()
    {
        return $this->hasMany('App\RoomReservation');   // a Room has many roomReservations
    }
    public function notAvailables()
    {
        return $this->hasMany('App\NotAvailable ');   // a room has many notAvailables
    }
}
