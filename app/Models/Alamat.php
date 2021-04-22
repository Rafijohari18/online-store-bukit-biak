<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table = 'alamat';
    protected $guarded = [];

    public function Province()
    {
    	return $this->belongsTo('App\Models\Province','provinsi_id');
    }
     public function City(){
        return $this->belongsTo('App\Models\City','kota_id');
    }
    public function Kecamatan()
    {
    	return $this->belongsTo('App\Models\Kecamatan','kecamatan_id');
    }
     public function Desa(){
        return $this->belongsTo('App\Models\Desa','desa_id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User','user_id');
    }

}
