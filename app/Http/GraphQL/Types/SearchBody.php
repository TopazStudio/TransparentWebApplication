<?php

namespace App\Http\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
class SearchBody extends GraphQLType
{
    protected $searchedType;

    protected $attributes = [
        'name' => 'searchBody',
        'description' => 'Search Results'
    ];

    /**
     * Type fields.
     *
     * @return array
     */
    public function fields()
    {
        return [
            'blog',
            'comment',
            'document',
            'picture',
            'reply',
            'review',
            'tag',
            'topic',
            'user'
        ];
    }

    /**
     * Get the type of items being paginated.
     *
     */
    protected function itemsType(){
        return Type::listOf(GraphQL::type($this->searchedType));
    }

    public static function WithType($type){
        $instance = new static;
        $instance->searchedType = $type;
        return $instance;
    }
}
