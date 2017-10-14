<?php

namespace App\Http\GraphQL\Types;

use App\Model\Tag;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Nuwave\Lighthouse\Support\Interfaces\RelayType;

class TagType extends GraphQLType implements RelayType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'tag',
        'description' => 'A tag on entity'
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
        Tag::find($id);
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
                'description' => 'Tag name.',
            ],
            'topics' => [
                'type' => Type::listOf(GraphQL::type('topic')),
                'resolve' => function($tag, array $args){
                    return $tag->topics;
                }
            ],
            'blogs' => [
                'type' => Type::listOf(GraphQL::type('company')),
                'resolve' => function($tag, array $args){
                    return $tag->blogs;
                }
            ],
        ];
    }
}
