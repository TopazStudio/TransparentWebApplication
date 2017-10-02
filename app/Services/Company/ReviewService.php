<?php

namespace App\Services\Company;


use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;

class ReviewService implements CRUDService
{
    use HandlesCRUD;

    public function getModelType()
    {
        return 'App\Model\Review';
    }
}