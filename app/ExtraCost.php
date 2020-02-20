<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraCost extends Model
{
    public function billCosts()
    {
        return $this->hasMany('App\BillCost');   // an extraCost has many billCosts
    }

}
