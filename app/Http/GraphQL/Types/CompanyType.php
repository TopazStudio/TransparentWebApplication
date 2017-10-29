<?php

namespace App\Http\GraphQL\Types;

use App\Model\Company;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Nuwave\Lighthouse\Support\Interfaces\RelayType;

class CompanyType extends GraphQLType implements RelayType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'company',
        'description' => 'A business or a company'
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
        Company::find($id);
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
                'description' => 'Id of the company.',
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'businessNo' => [
                'type' => Type::int(),
            ],
            'description' => [
                'type' => Type::string(),
            ],
            'latitude' => [
                'type' => Type::float(),
            ],
            'longitude' => [
                'type' => Type::float(),
            ],
            'reviews' => [
                'type' => Type::listOf(GraphQL::type('review')),
                'resolve' => function($company, array $args){
                    return $company->reviews;
                }
            ],
            'pictures' => [
                'type' => Type::listOf(GraphQL::type('picture')),
                'resolve' => function($company, array $args){
                    return $company->pictures;
                }
            ],
            'documents' => [
                'type' => Type::listOf(GraphQL::type('document')),
                'resolve' => function($company, array $args){
                    return $company->documents;
                }
            ],
            'relatedTopics' => [
                'type' => Type::listOf(GraphQL::type('topic')),
                'resolve' => function($company, array $args){
                    return $company->relatedTopics;
                }
            ],
            'relatedBlogs' => [
                'type' => Type::listOf(GraphQL::type('blog')),
                'resolve' => function($company, array $args){
                    return $company->relatedBlogs;
                }
            ],
        ];
    }
}
