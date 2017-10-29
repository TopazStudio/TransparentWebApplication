<?php

namespace App\Http\GraphQL\Types;

use App\Model\Review;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Nuwave\Lighthouse\Support\Interfaces\RelayType;

class ReviewType extends GraphQLType implements RelayType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'Review',
        'description' => 'A review made on a company'
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
        return Review::find($id);
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
                'description' => 'Id of the review.',
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'Review content.',
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'resolve' => function($review, array $args){
                    return $review->user;
                }
            ],
            'company' => [
                'type' => GraphQL::type('company'),
                'resolve' => function($review, array $args){
                    return $review->company;
                }
            ],
        ];
    }
}
