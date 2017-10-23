<?php
GraphQL::schema()->group(['namespace' => 'App\\Http\\GraphQL'], function (){
    //TYPES
    GraphQL::schema()->type('blog', 'Types\\BlogType');
    GraphQL::schema()->type('comment', 'Types\\CommentType');
    GraphQL::schema()->type('company', 'Types\\CompanyType');
    GraphQL::schema()->type('document', 'Types\\DocumentType');
    GraphQL::schema()->type('picture', 'Types\\PictureType');
    GraphQL::schema()->type('reply', 'Types\\ReplyType');
    GraphQL::schema()->type('review', 'Types\\ReviewType');
    GraphQL::schema()->type('tag', 'Types\\TagType');
    GraphQL::schema()->type('topic', 'Types\\TopicType');
    GraphQL::schema()->type('user', 'Types\\UserType');

    GraphQL::schema()->type('signInUserPayload', 'Types\\SignInUserPayload');
    GraphQL::schema()->type('searchBody', 'Types\\SearchBody');
    GraphQL::schema()->type('paginator', 'Types\\Paginators\\Paginator');

    //QUERIES
    GraphQL::schema()->query('viewer', 'Queries\\ViewerQuery');
    GraphQL::schema()->query('search', 'Queries\\SearchQuery');

    //TODO: make login a mutation
    GraphQL::schema()->query('login', 'Queries\\ViewerLogin');

    //MUTATIONS
    $dir = "../app/Http/GraphQL/Mutations";

    if (is_dir($dir)){
        if ($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false){
                if ($file ===  '.' || $file ===  '' || $file ===  '..') continue;

                $file = explode('.',$file);

                $type = strtolower($file[0]);

                GraphQL::schema()->mutation($type, 'Mutations\\' . $file[0]);
            }
            closedir($dh);
        }
    }

});