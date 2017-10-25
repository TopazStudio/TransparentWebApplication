<?php

namespace App\Http\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;

class SearchResult extends GraphQLType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => '',
        'description' => ''
    ];

    /**
     * Type fields.
     *
     * @return array
     */
    public function fields()
    {
        return [
            'took' => [
                'type' => Type::int(),
                'resolve' => function ($result,array $args){
                    return $result->took();
                }
            ],
            'totalHits' => [
                'type' => Type::int(),
                'resolve' => function ($result,array $args){
                    return $result->totalHits();
                }
            ],
            'maxScore' => [
                'type' => Type::float(),
                'resolve' => function ($result,array $args){
                    return $result->maxScore();
                }
            ],
            'aggregations' => [
                'type' => Type::int(),
                'resolve' => function ($result,array $args){
                    return $result->aggregations();
                }
            ],
            'hits' => [
                'type' => Type::int(),
                'resolve' => function ($result,array $args){
                    return $result->hits();
                }
            ],
        ];
    }
}
