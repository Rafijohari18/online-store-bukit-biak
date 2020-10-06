<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model; 

class Desa extends Model {
     
    protected $table = 'desa';
    public $timestamps = false;
    
     public function Alamat()
    {
    	return $this->hasMany('App\Models\Alamat','desa_id');
    }
    
    
}