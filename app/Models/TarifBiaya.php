<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifBiaya extends Model
{
    use HasFactory;
    
    protected $table = 'costs';

    protected $guarded = [];

    protected $casts = [
        'costs' => 'json',
    ];
    
}
