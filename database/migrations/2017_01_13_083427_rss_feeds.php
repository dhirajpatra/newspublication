<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RssFeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_feeds', function (Blueprint $table) {
            $table->increments('rss_feed_id');
            $table->string('rss_feed_title');
            $table->text('rss_feed_description');
            $table->text('rss_feed_link');
            $table->string('rss_feed_language');
            $table->string('rss_feed_image_title');
            $table->string('rss_feed_image_url')->unique();
            $table->string('rss_feed_image_link');
            $table->integer('rss_feed_image_width');
            $table->integer('rss_feed_image_height');
            //$table->timestamp('rss_feed_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            //$table->timestamp('rss_feed_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rss_feeds');
    }
}
