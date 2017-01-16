<?php

namespace App\Http\Controllers;

use App\Rss;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

use Auth;
use Hash;
use Flash;
use Crypt;
use Carbon\Carbon;

use App\News;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RssController extends Controller
{
    /**
     * @return string
     */
    public function getFeed()
    {
        $feeds = $this->_getDetails();
        //return View::make('rss.feed', ['feeds' => $feeds]);
        return response($feeds)->header('Content-Type', 'application/xml; charset=ISO-8859-1');
    }

    private function _getDetails()
    {
        $rssFeedObj = new Rss();
        $rssFeedList = $rssFeedObj->getDetails();
        //print_r($rssFeedList); exit;
        $details = '<?xml version="1.0" encoding="ISO-8859-1" ?>
				<rss version="2.0">';

        foreach($rssFeedList as $rssFeed)
        {
            $details .= '<channel>
                            <title>'. $rssFeed['rss_feed_title'] .'</title>
                            <link>'. $rssFeed['rss_feed_link'] .'</link>
                            <description>'. $rssFeed['rss_feed_description'] .'</description>
                            <language>'. $rssFeed['rss_feed_language'] .'</language>
                            <image>
                                <title>'. $rssFeed['rss_feed_image_title'] .'</title>
                                <url>'. url('/newsimages/' . $rssFeed['rss_feed_image_url']) .'</url>
                                <link>'. $rssFeed['rss_feed_image_link'] .'</link>
                                <width>'. $rssFeed['rss_feed_image_width'] .'</width>
                                <height>'. $rssFeed['rss_feed_image_height'] .'</height>
                            </image>';

            $items =  $this->_getItems($rssFeed['rss_feed_id']);

            $details .= $items;
            $details .= '</channel>
				</rss>';
        }

        return $details;
    }

    /**
     * Return all news items
     * @param $feedId
     * @return string
     */
    private function _getItems($feedId)
    {
        $newsObj = new News();
        $newsItems = $newsObj->getNewsListForFeed($feedId);

        $items = '';
        foreach ($newsItems as $news)
        {
            $items .= '<item>
                            <title>'. $news["news_title"] .'</title>
                            <link>'. url('/newsimages/'. $news["news_photo"]) .'</link>
                            <description><![CDATA['. $news["news_details"] .']]></description>
                        </item>';
        }

        return $items;
    }
}
