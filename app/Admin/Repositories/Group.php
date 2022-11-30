<?php

namespace App\Admin\Repositories;

use App\Models\Group as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Group extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
