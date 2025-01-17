<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    public function persons()
    {
        return $this->hasMany('App\Person', 'id');   // an age (has) belongs to many persons
    }
}
