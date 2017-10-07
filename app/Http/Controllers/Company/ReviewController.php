<?php

namespace App\Http\Controllers\Company;


use App\Services\Company\ReviewService;
use App\Util\CRUD\HandlesCRUDRequest;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    use HandlesCRUDRequest;

    public function __construct(ReviewService $companyService){
        $this->CRUDService = $companyService;

        $this->addValidationRules = [
            'content' => 'required|string|max:8000',
            'likes'=>'nullable|integer',
            'dislikes'=>'nullable|integer',
            'userId'=>'required|integer',
            'companyId'=>'required|integer'
        ];

        $this->updateValidationRules = [
            'content' => 'nullable|string|max:8000',
            'likes'=>'nullable|integer',
            'dislikes'=>'nullable|integer',
            'userId'=>'nullable|integer',
            'companyId'=>'nullable|integer'
        ];
    }
}