<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/3/17
 * Time: 6:27 PM
 */

namespace App\Http\Controllers\Topic;


use App\Http\Controllers\Controller;
use App\Services\Topic\CommentService;
use App\Util\CRUD\HandlesCRUDRequest;

class CommentController extends Controller
{
    use HandlesCRUDRequest;

    public function __construct(CommentService $companyService){
        $this->CRUDService = $companyService;

        $this->addValidationRules = [
            'content' => 'required|string|max:8000',
            'likes'=>'nullable|integer',
            'dislikes'=>'nullable|integer',
            'userId'=>'required|integer',
            'topicId'=>'required|integer'
        ];

        $this->updateValidationRules = [
            'content' => 'nullable|string|max:8000',
            'likes'=>'nullable|integer',
            'dislikes'=>'nullable|integer',
            'userId'=>'nullable|integer',
            'topicId'=>'nullable|integer'
        ];
    }
}