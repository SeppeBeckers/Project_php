<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public function accommodationChoice()
    {
        return $this->belongsTo('App\ AccommodationChoice ')->withDefault();   // a price belongs to a accomodationChoice
    }
    public function occupancy()
    {
        return $this->belongsTo('App\ Occupancy')->withDefault();   // a price belongs to a occupancy
    }
    public function typeRoom()
    {
        return $this->belongsTo('App\ TypeRoom ')->withDefault();   // a price belongs to a typeRoom
    }
}
