<?php

namespace App\Services\Company;


use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;
use App\Util\CRUD\HandlesGraphQLCRUD;

class ReviewService implements CRUDService
{
    use HandlesCRUD,HandlesGraphQLCRUD;

    public function getModelType()
    {
        return 'App\Model\Review';
    }
}