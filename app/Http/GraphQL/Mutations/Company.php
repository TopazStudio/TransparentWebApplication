<?php

namespace App\Http\GraphQL\Mutations;

use App\Http\Controllers\Company\CompanyController;
use App\Services\Company\CompanyService;
use App\Traits\DoesGraphqlResponse;
use App\Util\CRUD\HandlesGraphQLCRUDRequest;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Illuminate\Http\Request;
use GraphQL;
use Mockery\Exception;
use Nuwave\Lighthouse\Support\Definition\GraphQLMutation;

class Company extends GraphQLMutation
{
    use HandlesGraphQLCRUDRequest,DoesGraphqlResponse;

    protected $request;

    public function __construct($attributes = [],Request $request,CompanyService $CRUDService)
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
        'name' => 'company'
    ];

    /**
     * Type that mutation returns.
     *
     * @return ObjectType
     */
    public function type()
    {
         return GraphQL::type('company');
    }
}
