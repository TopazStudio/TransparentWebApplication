<?php

namespace App\Http\GraphQL\Types;

use App\Model\Picture;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Nuwave\Lighthouse\Support\Interfaces\RelayType;

class PictureType extends GraphQLType implements RelayType
{
    /**
     * Attributes of type.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'picture',
        'description' => 'A picture of some entity'
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
        Picture::find($id);
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
                'description' => 'Id of the picture.',
            ],
            'location' => [
                'type' => Type::string(),
            ],
            'picturable_id' => [
                'type' => Type::int(),
            ],
            'picturable_type' => [
                'type' => Type::string(),
            ],
        ];
    }
}
