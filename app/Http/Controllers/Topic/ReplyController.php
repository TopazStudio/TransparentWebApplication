<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/4/17
 * Time: 3:29 PM
 */

namespace App\Http\Controllers\Topic;


use App\Http\Controllers\Controller;
use App\Services\Topic\ReplyService;
use App\Util\CRUD\HandlesCRUDRequest;

class ReplyController extends Controller
{
    use HandlesCRUDRequest;

    public function __construct(ReplyService $replyService){
        $this->CRUDService = $replyService;

        $this->addValidationRules = [
            'content' => 'required|string|max:8000',
            'likes'=>'nullable|integer',
            'dislikes'=>'nullable|integer',
            'commentId'=>'required|integer',
            'userId'=>'required|integer'
        ];

        $this->updateValidationRules = [
            'content' => 'nullable|string|max:8000',
            'likes'=>'nullable|integer',
            'dislikes'=>'nullable|integer',
            'commentId'=>'nullable|integer',
            'UserId'=>'nullable|integer'
        ];
    }
}