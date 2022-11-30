<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    use HasFactory;

    protected $fillable = ['message_id', 'content', 'type'];

    protected $casts = [
        'content' => 'array',
        'from' => 'array',
        'chat' => 'array',
    ];

}
