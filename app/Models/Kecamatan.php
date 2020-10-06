<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model; 

class Kecamatan extends Model {
     
    protected $table = 'kecamatan';
    public $timestamps = false;
    
     public function Alamat()
    {
    	return $this->hasMany('App\Models\Alamat','kecamatan_id');
    }
    
    
}
