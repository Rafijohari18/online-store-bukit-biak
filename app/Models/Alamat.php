<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table = 'alamat';
    protected $guarded = [];

    public function Provinsi()
    {
    	return $this->belongsTo('App\Models\Provinsi','provinsi_id');
    }
     public function Kota(){
        return $this->belongsTo('App\Models\Kota','kota_id');
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
