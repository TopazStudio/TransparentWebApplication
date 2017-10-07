<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/4/17
 * Time: 4:00 PM
 */

namespace App\Http\Controllers\Company;


use App\Http\Controllers\Controller;
use App\Services\Company\DocumentService;
use App\Services\Topic\TopicService;
use App\Util\CRUD\HandlesCRUDRequest;

class DocumentController extends Controller
{
    use HandlesCRUDRequest;

    public function __construct(DocumentService $documentService){
        $this->CRUDService = $documentService;

        $this->addValidationRules = [
            'name' => 'required|string',
            'description' => 'required|string|max:800',
            'companyId'=>'nullable|integer',
            'userId' =>'required|integer',
        ];

        $this->updateValidationRules = [
            'name' => 'nullable|string',
            'description' => 'nullable|string|max:800',
            'companyId'=>'nullable|integer',
            'userId' =>'nullable|integer',
        ];
    }
}