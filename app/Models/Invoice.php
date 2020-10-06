<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $guarded = [];

    public function cart()
    {
    	return $this->belongsToMany('App\Models\Cart')->where('status',1);
    }
    
    public function User(){
        return $this->belongsTo('App\Models\User','user_id');
    }

}