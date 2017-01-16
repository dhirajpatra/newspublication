<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('news_id');
            $table->string('news_title');
            $table->string('news_photo');
            $table->text('news_details');
            $table->integer('news_reporter_id');
            $table->integer('news_rss_feed_id');
            //$table->timestamp('news_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            //$table->timestamp('news_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news');
    }
}
