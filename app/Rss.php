<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\News;

class Rss extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rss_feeds';

    /**
     * get details of rss feed
     * @return array
     */
    public function getDetails()
    {
        try {
            $rssList = Rss::all()
                ->toArray();

            return $rssList;

        }catch (\Exception $e){
            return array();
        }
    }

    /**
     * get all news items
     * @return array|string
     */
    public function getItems()
    {
        try {
            $newsList = News::orderBy('news_id', 'desc')
                ->toArray();
            return $newsList;

        }catch (\Exception $e){
            return array();
        }

    }
}
