<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Feeds;

class CrawlFeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /* -------------------------------
     * CRAWL FEED
     * -------------------------------
     * Crawl RSS feeds from one site and determines whether it has articles
     * corresponding with tags from any topic.
     *
     *
     * */


    private $site;

    /**
     * Create a new job instance.
     *
     * @param $site
     */
    public function __construct($site)
    {
        $this->site = $site;
    }

    /**
     * Execute the job.
     * @return void
     * @internal param $site
     */
    public function handle()
    {
        $feeds = Feeds::make($this->site);
        foreach ($feeds->get_items() as $item){
            //Search whether it has words contained in tags

            print $item->get_title() . '\n';
        }
    }
}
