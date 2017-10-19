<?php

namespace App\Http\GraphQL\Types\Paginators;


class CommentsPaginator extends Paginator
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'paginator',
        'description' => 'Retrieve paginated data'
    ];

    protected $type = 'comment';
}
