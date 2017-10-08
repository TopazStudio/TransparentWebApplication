<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/8/17
 * Time: 7:35 PM
 */

namespace App\Services;


use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;

class TagService implements CRUDService
{
    use HandlesCRUD;

    public function getModelType()
    {
        return 'App\Model\Tag';
    }
}