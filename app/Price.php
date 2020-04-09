<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public function accommodationChoice()
    {
        return $this->belongsTo('App\AccommodationChoice', 'accommodation_choice_id')->withDefault();   // a price belongs to a accomodationChoice
    }
    public function occupancy()
    {
        return $this->belongsTo('App\Occupancy', 'id')->withDefault();   // a price belongs to a occupancy
    }
    public function typeRoom()
    {
        return $this->belongsTo('App\TypeRoom', 'type_room_id')->withDefault();   // a price belongs to a typeRoom
    }
    public function arrangement()
    {
        return $this->belongsTo('App\Arrangement')->withDefault();   // a price belongs to a arrangement
    }

    protected $price = 'prices';
    protected $fillable = ['amount'];
}
