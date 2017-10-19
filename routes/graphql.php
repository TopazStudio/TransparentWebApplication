<?php
//TODO: auto load all.
/*$dir = "../app/Http/GraphQL/Queries";

if (is_dir($dir)){
    if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
            echo "filename:" . $file . "<br>";
        }
        closedir($dh);
    }
}*/

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
//    GraphQL::schema()->type('paginator', 'Types\\Paginators\\Paginator');



    GraphQL::schema()->query('viewerQuery', 'Queries\\ViewerQuery');
    GraphQL::schema()->query('viewerLogin', 'Queries\\ViewerLogin');
});