<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'attributes', 'user_id', 'browser_info', 'ip_address', 'country'];
    protected $casts = [
        'browser_info' => 'array',
    ];
}
