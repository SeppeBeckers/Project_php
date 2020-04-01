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
    public function typeRoom()
    {
        return $this->belongsTo('App\TypeRoom')->withDefault();   // a room has one type
    }
}
