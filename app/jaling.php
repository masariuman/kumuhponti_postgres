<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jaling extends Model
{
    protected $fillable = ['nama_lokasi','lokasi_keg','kecamatan','rencana','wilayah_id','data','user_id','luas','created_at','updated_at'];
    // protected $timestamps = true;

    public function daerah()
    {
        return $this->belongsTo('App\daerah','wilayah_id');
    }


    public function User()
    {
        return $this->belongsTo('App\User','user_id');
    }



    // // override the toArray function (called by toJson)
    // public function toArray() {
    //     // get the original array to be displayed
    //     $data = parent::toArray();

    //     // change the value of the 'mime' key
    //     if ($this->User) {
    //         $data['user_id'] = $this->User->name;
    //     } else {
    //         $data['user_id'] = null;
    //     }

    //     return $data;
    // }

}
