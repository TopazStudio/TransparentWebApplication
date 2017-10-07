<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/7/17
 * Time: 5:33 PM
 */

namespace App\Services\Blog;


use App\Jobs\CrawlFeed;
use App\Util\CRUD\HasErrorsAndInfo;
use Illuminate\Support\Facades\Storage;

class FeedService
{

    public static function getSites(){
        return json_decode(Storage::get('crawl/websites.json'));
    }

    public static function start(){
        //get list of websites to crawl
        if (!$sites = self::getSites()) return ;
        foreach ($sites as $site){
            CrawlFeed::dispatch($site->rssFeed);
        }
    }
}