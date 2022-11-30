<?php

namespace App\Admin\Repositories;

use App\Models\Response as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Response extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
