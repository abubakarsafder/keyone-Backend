<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'email',
        'mobile_code',
        'mobile_number',
        'location',
        'property_type',
        'no_of_bedrooms',
        'message',
    ];
}
