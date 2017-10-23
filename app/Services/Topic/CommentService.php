<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/3/17
 * Time: 6:51 PM
 */

namespace App\Services\Topic;


use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;
use App\Util\CRUD\HandlesGraphQLCRUD;

class CommentService implements CRUDService
{
    use HandlesCRUD,HandlesGraphQLCRUD;

    public function getModelType()
    {
        //TODO: get name of model from name of class.
        return 'App\Model\Comment';
    }

}