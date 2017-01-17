<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * @package App
 */
class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'news_id', 'news_title', 'news_details', 'news_photo', 'news_reporter_id', 'news_rss_feed_id', 'news_created_at', 'news_updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        try {
            return $this->hasOne('App\User', 'id', 'news_reporter_id');
        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }
    }

    /**
     * @param $limit
     * @return array
     */
    public function listNews($limit)
    {
        try {
            // fetching mails
            $news = $this->with('user')
                ->orderBy('news_id', 'desc')
                ->paginate($limit)
                ->toArray();
           
            return $news;
        }catch (\Exception $e){
            return array();
        }
    }

    /**
     * get news list for a feed type
     * @param $feedId
     * @return array
     */
    public function getNewsListForFeed($feedId)
    {
        try {
            // fetching mails
            $news = News::where([
                ['news_rss_feed_id', $feedId]
            ])
                ->orderBy('news_id', 'desc')
                ->limit(10)
                ->get()
                ->toArray();
            //echo "<pre>"; print_r($news); exit;
            return $news;
        }catch (\Exception $e){
            return array();
        }
    }
}
