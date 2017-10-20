<?php

namespace App\Http\GraphQL\Types;

use App\Model\Blog;
use App\Model\Comment;
use App\Model\Company;
use App\Model\Document;
use App\Model\Tag;
use App\Model\Topic;
use App\Model\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Model;
use Nuwave\Lighthouse\Support\Definition\GraphQLType;
use Sleimanx2\Plastic\Facades\Plastic;
use Sleimanx2\Plastic\Fillers\EloquentFiller;
use Sleimanx2\Plastic\PlasticResult;

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
            'blog' => [
                'type' => Type::listOf(GraphQL::type('blog')),
                'args' => [
                    'raw' => [
                        'type' => Type::string(),
                        'rules' => ['required']
                    ]
                ],
                'resolve' => function($payload,array $args){
                    return $this->rawSearch(new Blog(),$args)->hits();
                }
            ],
            'company'  => [
                'type' => Type::listOf(GraphQL::type('company')),
                'args' => [
                    'raw' => [
                        'type' => Type::string(),
                        'rules' => ['required']
                    ]
                ],
                'resolve' => function($payload,array $args){
                    return $this->rawSearch(new Company(),$args)->hits();
                }
            ],
            'comment' => [
                'type' => Type::listOf(GraphQL::type('comment')),
                'args' => [
                    'raw' => [
                        'type' => Type::string(),
                        'rules' => ['required']
                    ]
                ],
                'resolve' => function($payload,array $args){
                    return $this->rawSearch(new Comment(),$args)->hits();
                }
            ],
            'document'  => [
                'type' => Type::listOf(GraphQL::type('document')),
                'args' => [
                    'raw' => [
                        'type' => Type::string(),
                        'rules' => ['required']
                    ]
                ],
                'resolve' => function($payload,array $args){
                    return $this->rawSearch(new Document(),$args)->hits();
                }
            ],
            'tag'  => [
                'type' => Type::listOf(GraphQL::type('tag')),
                'args' => [
                    'raw' => [
                        'type' => Type::string(),
                        'rules' => ['required']
                    ]
                ],
                'resolve' => function($payload,array $args){
                    return $this->rawSearch(new Tag(),$args)->hits();
                }
            ],
            'topic'  => [
                'type' => Type::listOf(GraphQL::type('topic')),
                'args' => [
                    'raw' => [
                        'type' => Type::string(),
                        'rules' => ['required']
                    ]
                ],
                'resolve' => function($payload,array $args){
                    return $this->rawSearch(new Topic(),$args)->hits();
                }
            ],
            'user' => [
                'type' => Type::listOf(GraphQL::type('user')),
                'args' => [
                    'raw' => [
                        'type' => Type::string(),
                        'rules' => ['required']
                    ]
                ],
                'resolve' => function($payload,array $args) {
                    return $this->rawSearch(new User(),$args)->hits();
                }
            ]
        ];
    }

    protected function rawSearch(Model $model,$args){
        $results = new PlasticResult(Plastic::getClient()->search(json_decode($args['raw'])));
        $filler = new EloquentFiller();
        $filler->fill($model, $results);
        return $results;
    }
}
