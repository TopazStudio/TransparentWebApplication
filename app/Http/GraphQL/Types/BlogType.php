<?php

namespace App\Http\GraphQL\Types;

use App\Model\Blog;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Nuwave\Lighthouse\Support\Interfaces\RelayType;

class BlogType extends GraphQLType implements RelayType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'blog',
        'description' => 'A blog associated with a topic'
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
        Blog::find($id);
    }

    /**
     * Type fields.
     *
     * @return array
     */
    public function fields()
    {
        return [
            'url' => [
                'type' => Type::string(),
                'description' => 'Blog url.',
            ],
            'heading' => [
                'type' => Type::string(),
                'description' => 'Blog heading.',
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'Blog content.',
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'resolve' => function($blog, array $args){
                    return $blog->user;
                }
            ],
            'companiesAbout' => [
                'type' => Type::listOf(GraphQL::type('company')),
                'resolve' => function($blog, array $args){
                    return $blog->companiesAbout;
                }
            ],
            'topic' => [
                'type' => GraphQL::type('topic'),
                'resolve' => function($blog, array $args){
                    return $blog->topic;
                }
            ],
            'tags' => [
                'type' => Type::listOf(GraphQL::type('tag')),
                'resolve' => function($blog, array $args){
                    return $blog->tags;
                }
            ],
        ];
    }
}
