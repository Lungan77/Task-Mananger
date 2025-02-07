<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $fillable = [
        'name', 'image', 'description', 'status', 'user_Id'
    ];
}
