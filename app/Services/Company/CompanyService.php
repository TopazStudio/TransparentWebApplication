<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 9/30/17
 * Time: 12:46 PM
 */

namespace App\Services\Company;


use App\Traits\HasErrorsAndInfo;
use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;

class CompanyService implements CRUDService
{
    use HandlesCRUD;

    public function __construct(){
        $this->picType = 'companyPic';
        $this->picPath = 'public/companyPic';
    }

    public function getModelType()
    {
        return 'App\Model\Company';
    }
}
