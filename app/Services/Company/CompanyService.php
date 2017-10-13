<?php

namespace App\Services\Company;

use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;

class CompanyService implements CRUDService
{
    use HandlesCRUD;

    public function __construct(){
        $this->picType = 'companyPic';
        $this->picPath = 'companyPic';
    }

    public function getModelType()
    {
        return 'App\Model\Company';
    }
}
