<?php

namespace App\Http\GraphQL\Types;

use App\Model\Reply;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Nuwave\Lighthouse\Support\Interfaces\RelayType;

class ReplyType extends GraphQLType implements RelayType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'reply',
        'description' => 'A reply on a comment.'
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
        Reply::find($id);
    }

    /**
     * Type fields.
     *
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'Id of the reply.',
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'Reply content.',
            ],
            'likes' => [
                'type' => Type::int(),
                'description' => 'How many people liked this reply',
            ],
            'dislikes' => [
                'type' => Type::int(),
                'description' => 'How many people disliked this reply',
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'resolve' => function($reply, array $args){
                    return $reply->user;
                }
            ],
            'comment' => [
                'type' => GraphQL::type('comment'),
                'resolve' => function($reply, array $args){
                    return $reply->comment;
                }
            ],
        ];
    }
}
