<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/8/17
 * Time: 7:34 PM
 */

namespace App\Http\Controllers;


use App\Services\TagService;
use App\Util\CRUD\HandlesCRUDRequest;

class TagController extends Controller
{
    use HandlesCRUDRequest;

    public function __construct(TagService $companyService){
        $this->CRUDService = $companyService;

        $this->addValidationRules = [
            'name' => 'required|string|unique:tags',
        ];

        $this->updateValidationRules = [
            'name' => 'required|string|unique:tags',
        ];
    }
}