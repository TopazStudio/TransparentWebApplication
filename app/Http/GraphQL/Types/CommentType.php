<?php

namespace App\Http\GraphQL\Types;

use App\Http\GraphQL\Connections\UserCommentsConnection;
use App\Model\Comment;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Nuwave\Lighthouse\Support\Interfaces\RelayType;

class CommentType extends GraphQLType implements RelayType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'comment',
        'description' => 'A comment on a topic'
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
        Comment::find($id);
    }

    /**
     * Type fields.
     *
     * @return array
     */
    public function fields()
    {
        return [
            'content' => [
                'type' => Type::string(),
                'description' => 'Comment content.',
            ],
            'likes' => [
                'type' => Type::int(),
                'description' => 'How many people liked this comment',
            ],
            'dislikes' => [
                'type' => Type::int(),
                'description' => 'How many people disliked this comment',
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'resolve' => function($comment,array $args){
                    return $comment->user;
                }
            ],
            'topic' => [
                'type' => GraphQL::type('topic'),
                'resolve' => function($comment,array $args){
                    return $comment->topic;
                }
            ],
            'replies' => [
                'type' => GraphQL::type('reply'),
                'resolve' => function($comment,array $args){
                    return $comment->replies;
                }
            ]
        ];
    }
}
