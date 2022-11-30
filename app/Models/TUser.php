<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TUser extends Model
{
    use HasFactory;

    /**

     * 允许所有字段 可以批量填充

     *

     * @var array

     */

    protected $guarded = [];
}
