<?php

namespace App\Services;

use App\Models\Response;
use Illuminate\Support\Facades\Log;

class ResponseService
{
    public static function create($res, $deltime = 60)
    {
        $response = new Response();
        $data = formatMessage($res, 'response');
        $data['deltime'] = $deltime;
        $response->fill($data);
        $response->save();
    }
}
