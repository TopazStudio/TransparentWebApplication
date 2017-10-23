<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/4/17
 * Time: 3:24 PM
 */

namespace App\Services\Topic;


use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;
use App\Util\CRUD\HandlesGraphQLCRUD;

class ReplyService implements CRUDService
{
    use HandlesCRUD,HandlesGraphQLCRUD;

    public function getModelType()
    {
        return 'App\Model\Reply';
    }
}