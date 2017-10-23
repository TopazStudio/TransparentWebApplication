<?php

namespace App\Http\GraphQL\Mutations;

use GraphQL;
use App\Services\Topic\CommentService;
use App\Traits\DoesGraphqlResponse;
use App\Util\CRUD\HandlesGraphQLCRUDRequest;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Illuminate\Http\Request;
use Nuwave\Lighthouse\Support\Definition\GraphQLMutation;

class Comment extends GraphQLMutation
{
    use HandlesGraphQLCRUDRequest,DoesGraphqlResponse;

    protected $request;

    public function __construct($attributes = [],Request $request,CommentService $CRUDService)
    {
        parent::__construct($attributes);
        $this->request = $request;
        $this->CRUDService = $CRUDService;
    }

    /**
     * Attributes of mutation.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'comment'
    ];

    /**
     * Type that mutation returns.
     *
     * @return ObjectType
     */
    public function type()
    {
         return GraphQL::type('comment');
    }
}
