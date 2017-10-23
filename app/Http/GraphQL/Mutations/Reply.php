<?php

namespace App\Http\GraphQL\Mutations;

use App\Services\Topic\ReplyService;
use App\Traits\DoesGraphqlResponse;
use App\Util\CRUD\HandlesGraphQLCRUDRequest;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Illuminate\Http\Request;
use Nuwave\Lighthouse\Support\Definition\GraphQLMutation;

class Reply extends GraphQLMutation
{
    use HandlesGraphQLCRUDRequest,DoesGraphqlResponse;

    protected $request;

    public function __construct($attributes = [],Request $request,ReplyService $CRUDService)
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
        'name' => 'reply'
    ];

    /**
     * Type that mutation returns.
     *
     * @return ObjectType
     */
    public function type()
    {
         return GraphQL::type('reply');
    }
}
