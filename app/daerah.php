<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class daerah extends Model
{
    public function layer()
    {
        return $this->hasMany('App\layer', 'daerahs_id', 'id');
    }

    public function data()
    {
        return $this->hasMany('App\data', 'daerahs_id', 'id');
    }

    public function jaling()
    {
        return $this->hasMany('App\jaling', 'wilayah_id', 'id');
    }
}
