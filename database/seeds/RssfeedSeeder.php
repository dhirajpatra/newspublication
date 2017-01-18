<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class RssfeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $rss = ['rss_feed_title' => 'Top News','rss_feed_description' => "Subscribe to Our News's RSS(Really Simple Syndication) feeds to get news delivered directly to your desktop!\r\n\r\nTo view one of the Crossover News feeds in your RSS Aggregator(About RSS Aggregators): \r\n1 . Copy the URL / shortcut that corresponds to the topic that interests you . \r\n2 . Paste the URL into your reader .",'rss_feed_link' => '', 'rss_feed_language' => 'English', 'rss_feed_image_title' => 'Header RSS Button', 'rss_feed_image_url' => 'header_rss_btn.gif', 'rss_feed_image_link' => 'header_rss_btn.gif', 'rss_feed_image_width' => '30', 'rss_feed_image_height' => '30', 'created_at' => '2017-01-15 03:38:28', 'updated_at' => '2017-01-15 03:38:28'];
        $db = DB::table('rss_feeds')->insert($rss);
    }
}
