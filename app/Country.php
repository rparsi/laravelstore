<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    const ALPHA3_CODE_CANADA = 'CAN';
    const ALPHA3_CODE_USA = 'USA';

    public function currencies()
    {
        return $this->hasMany('App\Currency');
    }
}
