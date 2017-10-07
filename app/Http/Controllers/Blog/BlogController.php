<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/3/17
 * Time: 7:27 PM
 */

namespace App\Http\Controllers\Blog;


use App\Http\Controllers\Controller;
use App\Services\Blog\BlogService;
use App\Util\CRUD\HandlesCRUDRequest;

class BlogController extends Controller
{
    use HandlesCRUDRequest;

    public function __construct(BlogService $blogService){
        $this->CRUDService = $blogService;

        $this->addValidationRules = [
            'url' => 'required|string|max:800',
            'heading' => 'nullable|string|max:200',
            'content' => 'nullable|string|max:800',
            'userId'=>'required|integer',
            'topicId'=>'required|integer'
        ];

        $this->updateValidationRules = [
            'url' => 'nullable|string|max:800',
            'heading' => 'nullable|string|max:200',
            'content' => 'nullable|string|max:800',
            'userId'=>'required|integer',
            'topicId'=>'required|integer'
        ];
    }
}