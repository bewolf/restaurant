<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'zone', 'is_available'
    ];
}
