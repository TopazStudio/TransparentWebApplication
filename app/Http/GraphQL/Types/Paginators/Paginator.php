<?php

namespace App\Http\GraphQL\Types\Paginators;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;

class Paginator extends GraphQLType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'paginator',
        'description' => 'Retrieve paginated data'
    ];

    /**
     * Type of the items being paginated.
     *
     * @var array
     */
    protected $type = 'comment';

    /**
     * Type fields.
     *
     * @return array
     */
    public function fields()
    {
        return [
            'count' => [
                'type' => Type::int(),
                'resolve' => function($model, array $args){
                    return $model->count();
                }
            ],
            'total' => [
                'type' => Type::int(),
                'resolve' => function($model, array $args){
                    return $model->total();
                }
            ],
            'hasNextPage' => [
                'type' => Type::boolean(),
                'resolve' => function($model, array $args){
                    return $model->hasMorePages();
                }
            ],
            'currentPage' => [
                'type' => Type::int(),
                'resolve' => function($model, array $args){
                    return $model->currentPage();
                }
            ],
            'items' => [
                'type' => $this->itemsType(),
                'resolve' => function($model, array $args){
                    return $model->items();
                }
            ],

        ];
    }

    protected function itemsType(){
        return Type::listOf(GraphQL::type($this->type));
    }
}
