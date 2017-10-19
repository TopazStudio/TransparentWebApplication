<?php

namespace App\Http\GraphQL\Queries;

use GraphQL;
use JWTAuth;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Nuwave\Lighthouse\Support\Definition\GraphQLQuery;

class ViewerLogin extends GraphQLQuery
{
    /**
     * Type query returns.
     *
     * @return Type
     */
    public function type()
    {
         return GraphQL::type('signInUserPayload');
    }

    /**
     * Available query arguments.
     *
     * @return array
     */
    public function args()
    {
        return [
            'email' => [
                'type' => Type::string(),
                'rules' => ['required']
            ],
            'password' => [
                'type' => Type::string(),
                'rules' => ['required']
            ]
        ];
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
        try {
            if (! $token = JWTAuth::attempt($args)) {
                return null;
            }
        } catch (JWTException $e) {
            return false;
        }
        return [
            'token' => $token,
            'user' => Auth::guard()->user()
        ];
    }
}
