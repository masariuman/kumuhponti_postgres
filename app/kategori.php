<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    public function data()
    {
        return $this->hasMany('App\data', 'kategoris_id', 'id');
    }

    public function layer()
    {
        return $this->hasMany('App\layer', 'kategoris_id', 'id');
    }
}
