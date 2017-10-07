<?php

namespace App\Console\Commands;

use App\Services\Blog\FeedService;
use Illuminate\Console\Command;

class CrawlFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:feeds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loop through feeds specified in configuration file searching for relations with particular topics';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        FeedService::start();
    }
}
