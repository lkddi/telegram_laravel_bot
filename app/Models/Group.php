<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

//    protected $fillable = ['chat_id', 'title', 'username', 'type', 'invite_link','permissions'];

    /**
     * 允许所有字段 可以批量填充
     *
     * @var array
     */
    protected $guarded = [];
    protected $casts = [
        'permissions' => 'array',
    ];

    public function admin()
    {
        return $this->hasMany(TAdminUser::class);
    }
    public function user()
    {
        return $this->hasMany(TUser::class);
    }
}
