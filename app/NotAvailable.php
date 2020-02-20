<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotAvailable extends Model
{
    public function room()
    {
        return $this->belongsTo('App\Room')->withDefault();   // a notAvailable belongs to a room
    }
}
