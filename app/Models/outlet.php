<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'picture', 
        'address', 
        'longitude', 
        'latitude',
        'brand_id'
    ];
}
