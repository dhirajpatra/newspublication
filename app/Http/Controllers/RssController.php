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

/**
 * Class RssController
 * @package App\Http\Controllers
 */
class RssController extends Controller
{
    /**
     * Create RSS Feed
     * @return string
     */
    public function getFeed()
    {
        try {
            $feeds = $this->_getDetails();
            return response($feeds)->header('Content-Type', 'application/xml; charset=ISO-8859-1');
        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }
    }

    /**
     * get details of RSS feed 
     * @return string
     */
    private function _getDetails()
    {
        try {
            $rssFeedObj = new Rss();
            $rssFeedList = $rssFeedObj->getDetails();

            $details = '<?xml version="1.0" encoding="ISO-8859-1" ?>
				<rss version="2.0">';

            foreach ($rssFeedList as $rssFeed) {
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

        } catch (Exception $e) {
            return array();
        }
    }

    /**
     * Return all news items
     * @param $feedId
     * @return string
     */
    private function _getItems($feedId)
    {
        try {
            $newsObj = new News();
            $newsItems = $newsObj->getNewsListForFeed($feedId);

            $items = '';
            foreach ($newsItems as $news) {
                $items .= '<item>
                            <title>'. $news["news_title"] .'</title>
                            <link>'. url('/newsimages/'. $news["news_photo"]) .'</link>
                            <description><![CDATA['. $news["news_details"] .']]></description>
                        </item>';
            }
            return $items;

        } catch (Exception $e) {
            return array();
        }
    }
}
