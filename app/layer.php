<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class layer extends Model
{
    public function kategori()
    {
        return $this->belongsTo('App\kategori','kategoris_id');
    }

    public function daerah()
    {
        return $this->belongsTo('App\daerah','daerahs_id');
    }
}
