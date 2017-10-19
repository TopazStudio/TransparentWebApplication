<?php

namespace App\Http\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;

class SignInUserPayload extends GraphQLType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'signInUserPayload',
        'description' => 'SignInUserPayload bundles information about the `user` and `token`'
    ];

    /**
     * Type fields.
     *
     * @return array
     */
    public function fields()
    {
        return [
            'user' => [
                'type' => GraphQL::type('user'),
                'resolve' => function($payload,array $args){
                    return $payload['user'];
                }
            ],
            'token' => [
                'type' => Type::string(),
                'resolve' => function($payload,array $args){
                    return $payload['token'];
                }
            ],
        ];
    }
}
