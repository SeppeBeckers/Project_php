<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillCost extends Model
{
    public function extraCost()
    {
        return $this->belongsTo('App\ExtraCost')->withDefault();   // a billCost belongs to a extraCost
    }
    public function bill()
    {
        return $this->belongsTo('App\Bill')->withDefault();   // a billCost belongs to a bill
    }

}
