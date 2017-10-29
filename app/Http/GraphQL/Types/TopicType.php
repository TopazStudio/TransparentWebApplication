<?php

namespace App\Http\GraphQL\Types;

use App\Model\Topic;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Nuwave\Lighthouse\Support\Interfaces\RelayType;

class TopicType extends GraphQLType implements RelayType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'topic',
        'description' => 'A topic about a company'
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
        Topic::find($id);
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
                'description' => 'Id of the topic.',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Name of the topic.',
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'A small description of the topic.',
            ],
            'likes' => [
                'type' => Type::int(),
                'description' => 'How many people liked this topic',
            ],
            'dislikes' => [
                'type' => Type::int(),
                'description' => 'How many people disliked this topic',
            ],
            'owner' => [
                'type' => GraphQL::type('user'),
                'resolve' => function($topic, array $args){
                    return $topic->owner;
                }
            ],
            'comments' => [
                'type' => Type::listOf(GraphQL::type('comment')),
                'resolve' => function($topic, array $args){
                    return $topic->comments;
                }
            ],
            'blogs' => [
                'type' => Type::listOf(GraphQL::type('blog')),
                'resolve' => function($topic, array $args){
                    return $topic->blogs;
                }
            ],
            'tags' => [
                'type' => Type::listOf(GraphQL::type('tag')),
                'resolve' => function($topic, array $args){
                    return $topic->tags;
                }
            ],
            'joinedUsers' => [
                'type' => Type::listOf(GraphQL::type('user')),
                'resolve' => function($topic, array $args){
                    return $topic->joinedUsers;
                }
            ],
            'companiesAbout' => [
                'type' => Type::listOf(GraphQL::type('company')),
                'resolve' => function($topic, array $args){
                    return $topic->companiesAbout;
                }
            ],

        ];
    }
}
