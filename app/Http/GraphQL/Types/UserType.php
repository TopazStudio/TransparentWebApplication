<?php

namespace App\Http\GraphQL\Types;

use App\Http\GraphQL\Connections\UserCommentsConnection;
use App\Http\GraphQL\Connections\UserReviewsConnection;
use App\Model\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Nuwave\Lighthouse\Support\Interfaces\RelayType;

class UserType extends GraphQLType implements RelayType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'user',
        'description' => 'Transparent Application User'
    ];

    /**
     * Get model by id.
     *
     * Note: When the root 'node' query is called, this method
     * will be used to resolve the type by providing the id.
     *
     * @param  mixed $id
     * @return mixed
     */
    public function resolveById($id)
    {
        return \App\Model\User::find($id);
    }

    /**
     * Type fields.
     *
     * @return array
     */
    public function fields()
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'Name of the user.',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'Email address of the user.',
            ],
            'role' => [
                'type' => Type::string(),
                'description' => 'Role of the user.',
            ],
            'review' => [
                'type' => GraphQL::type('review'),
                'description' => 'Users review on a company.',
                'resolve' => function($user,array $args){
                    return $user->review;
                }
            ],
            'comments' => [
                'type' => Type::listOf(GraphQL::type('comment')),
                'description' => 'Users comments on a topic.',
                'resolve' => function($user,array $args){
                    return $user->comments;
                }
            ],
            'topicsOwned' => [
                'type' => Type::listOf(GraphQL::type('topic')),
                'description' => 'Users review on a company.',
                'resolve' => function($user,array $args){
                    return $user->topics;
                }
            ],
            'joinedTopics' => [
                'type' => Type::listOf(GraphQL::type('topic')),
                'description' => 'Users review on a company.',
                'resolve' => function($user,array $args){
                    return $user->joinedTopics;
                }
            ],
            'blogs' => [
                'type' => Type::listOf(GraphQL::type('blog')),
                'description' => 'Users review on a company.',
                'resolve' => function($user,array $args){
                    return $user->blogs;
                }
            ],
            'documents' => [
                'type' => Type::listOf(GraphQL::type('document')),
                'description' => 'Users review on a company.',
                'resolve' => function($user,array $args){
                    return $user->documents;
                }
            ],
            'pictures' => [
                'type' => Type::listOf(GraphQL::type('picture')),
                'description' => 'Users review on a company.',
                'resolve' => function($user,array $args){
                    return $user->pictures;
                }
            ],

        ];
    }
}
