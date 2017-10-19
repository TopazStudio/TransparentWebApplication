<?php

namespace App\Http\GraphQL\Connections;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Interfaces\Connection;

class UserCommentsConnection implements Connection
{

    /**
     * Get the name of the connection.
     * Note: Connection names must be unique
     *
     * @return string
     */
    public function name()
    {
        return 'UserCommentsConnection';
    }

    /**
     * Get name of connection.
     *
     * @return string
     */
    public function type()
    {
        return 'comment';
    }

    /**
     * Available connection arguments.
     *
     * @return array
     */
    public function args()
    {
        return [];
    }

    /**
     * Resolve connection.
     *
     * @param  mixed  $parent
     * @param  array  $args
     * @param  mixed  $context
     * @param  ResolveInfo $info
     * @return mixed
     */
    public function resolve($parent, array $args, $context, ResolveInfo $info)
    {
        return $parent->comments()->getConnection($args);
    }
}
