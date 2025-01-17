<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model
{


    public function room()
    {
        return $this->belongsTo('App\Room', 'room_id')->withDefault();   // a roomReservation belongs to a room
    }
    public function reservation()
    {
        return $this->belongsTo('App\Reservation', 'reservation_id')->withDefault();   // a roomReservation belongs to a room
    }
}
