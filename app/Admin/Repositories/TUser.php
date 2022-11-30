<?php

namespace App\Admin\Repositories;

use App\Models\TUser as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class TUser extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
