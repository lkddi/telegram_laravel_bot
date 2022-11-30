<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasDateTimeFormatter;

    protected $fillable = ['message_id', 'chat_id', 'text', 'deltime'];

//    protected $casts = [
//        'text' => 'array',
//    ];
}
