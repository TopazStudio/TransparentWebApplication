<?php

namespace App\Http\GraphQL\Queries;

use GraphQL;
use JWTAuth;
use App\Model\User;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLQuery;

class ViewerQuery extends GraphQLQuery
{

    private $auth;

    /**
     * Type query returns.
     *
     * @return Type
     */
    public function type()
    {
        return GraphQL::type('user');
    }

    /**
     * Available query arguments.
     *
     * @return array
     */
    public function args()
    {
        return [
            'id' =>[
                'name' => 'id',
                'type' => Type::int()
            ]
        ];
    }

    public function authorize(array $args = [])
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }
        return (boolean) $this->auth;
    }

    /**
     * Resolve the query.
     *
     * @param  mixed  $root
     * @param  array  $args
     * @return mixed
     */
    public function resolve($root, array $args)
    {
        return $this->authorize() ? User::find($args['id']) : null;
    }
}
