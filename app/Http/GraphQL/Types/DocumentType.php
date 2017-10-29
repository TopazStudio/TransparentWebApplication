<?php

namespace App\Http\GraphQL\Types;

use App\Model\Document;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Nuwave\Lighthouse\Support\Interfaces\RelayType;

class DocumentType extends GraphQLType implements RelayType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'document',
        'description' => 'Legal document containing valuable info'
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
        Document::find($id);
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
                'description' => 'Id of the document.',
            ],
            'location' => [
                'type' => Type::string(),
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'description' => [
                'type' => Type::string(),
            ],
            'type' => [
                'type' => Type::string(),
            ],
            'size' => [
                'type' => Type::float(),
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'resolve' => function($document, array $args){
                    return $document->user;
                }
            ],
            'company' => [
                'type' => GraphQL::type('company'),
                'resolve' => function($document, array $args){
                    return $document->company;
                }
            ],
            'pictures' => [
                'type' => Type::listOf(GraphQL::type('picture')),
                'resolve' => function($document, array $args){
                    return $document->pictures;
                }
            ],
        ];
    }
}
