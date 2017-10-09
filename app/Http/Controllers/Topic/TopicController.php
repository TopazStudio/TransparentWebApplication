<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/2/17
 * Time: 12:07 PM
 */

namespace App\Http\Controllers\Topic;
use App\Http\Controllers\Controller;
use App\Services\Topic\TopicService;
use App\Util\CRUD\HandlesCRUDRequest;


class TopicController extends Controller
{
    use HandlesCRUDRequest;

    public function __construct(TopicService $companyService){
        $this->CRUDService = $companyService;

        $this->addValidationRules = [
            'name' => 'required|string|unique:topics',
            'description' => 'required|string|max:800',
            'likes'=>'nullable|integer',
            'dislikes'=>'nullable|integer',
            'ownerId' =>'required|integer',
        ];

        $this->updateValidationRules = [
            'name' => 'nullable|string|unique:topics',
            'description' => 'nullable|string|max:800',
            'likes'=>'nullable|integer',
            'dislikes'=>'nullable|integer',
            'ownerId' =>'nullable|integer',
        ];
    }
}