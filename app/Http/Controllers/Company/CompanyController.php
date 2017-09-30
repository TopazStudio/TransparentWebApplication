<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 9/30/17
 * Time: 12:54 PM
 */

namespace App\Http\Controllers\Company;


use App\Http\Controllers\Controller;
use App\Util\CRUD\HandlesCRUDRequest;
use App\Services\Company\CompanyService;

class CompanyController extends Controller
{
    use HandlesCRUDRequest;

    public function __construct(CompanyService $companyService){
        $this->CRUDService = $companyService;

        $this->validationRules = [
            'name' => 'required|string|unique:companies',
            'businessNo' => 'required|string|unique:companies',
            'description' => 'nullable|string|max:800',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image'
        ];
    }
}