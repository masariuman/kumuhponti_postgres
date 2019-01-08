<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history_edit extends Model
{
    protected $fillable = ['kumuh_id','lokaso','kecamatan','kelurahan','status','catatan','stats','user_id','luas','Catatan','created_at','updated_at'];
    // protected $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function jaling()
    {
        return $this->belongsTo('App\jaling','kumuh_id');
    }


    // override the toArray function (called by toJson)
    public function toArray() {
        // get the original array to be displayed
        $data = parent::toArray();

        // change the value of the 'mime' key
        if ($this->user) {
            $data['user_id'] = $this->User->name;
        } else {
            $data['user_id'] = null;
        }


        // change the value of the 'mime' key        
         $data['created_at'] = date('d F Y <br> H:i:s', strtotime($this->created_at));
        

        return $data;
    }
}
