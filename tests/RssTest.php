<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class RssTest
 */
class RssTest extends TestCase
{
    /**
     * this will test after seed a value into rss_feeds table
     */
    public function testRssFeedsTable()
    {
        $this->seeInDatabase('rss_feeds', ['rss_feed_title' => 'Top News']);
    }

    /**
     * This will test whether we can see the rss feed
     */
    public function testWeSeeRssFeeds()
    {
        $this->visit('/rss')
            ->see('Subscribe to Crossover News\'s RSS (Really Simple Syndication) feeds to get news delivered directly to your desktop!');
    }
}