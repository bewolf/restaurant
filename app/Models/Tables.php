<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'is_available'
    ];
}