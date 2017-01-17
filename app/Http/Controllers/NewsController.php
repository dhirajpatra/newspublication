<?php

namespace App\Http\Controllers;

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
use App\Rss;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * Class NewsController
 * @package App\Http\Controllers
 */
class NewsController extends Controller
{
    /**
     * open a news creating form
     * @return mixed
     */
    public function create()
    {
        try {
            // if user not logged in
            if(!isset(Auth::user()->username)){
                return redirect('/');
            }
            return View::make('news.create');
        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }

    }

    /**
     * save news data along with image
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'title' => 'required|min:6',
                'details' => 'required',
                'image' => 'required'
            ];
            $validator = Validator::make(Input::only('title', 'details', 'image'), $rules);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            if ($request->hasFile('image')) {
                $file = Input::file('image');
                //getting timestamp
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $name = $timestamp. '-' .$file->getClientOriginalName();
                $file->move(public_path().'/newsimages/', $name);
            }
            // rss feed id
            $rssFeed = Rss::first();
            //echo "<pre>"; echo $rssFeed->rss_feed_id; exit;
            News::create([
                'news_title' => Input::get('title'),
                'news_photo' => $name,
                'news_details' => Input::get('details'),
                'news_reporter_id' => Input::get('news_reporter_id'),
                'news_rss_feed_id' => $rssFeed->rss_feed_id,
            ]);

            \Session::flash('msg','Thanks for new news');
            return Redirect::home();
        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }

    }

    /**
     * delete a news
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        try {
            $userId = Auth::user()->id;
            $newsId = Crypt::decrypt($request->id);
            $news = News::where([
                ['news_id', $newsId]
            ])
                ->get()
                ->toArray();

            // need to check whether logged in user is creator of this news or not
            if($news[0]['news_reporter_id'] == $userId){
                $affectedRows  = News::where('news_id', '=', $newsId)->delete();
                if ($affectedRows > 0) {
                    \Session::flash('msg','News deleted');
                } else {
                    \Session::flash('msg','News couldn\'t be deleted');
                }

            }else{
                //Flash::message('News deleted as you are not authorised to delete this news.');
                \Session::flash('msg','News not deleted as you are not authorised to delete this news.');
            }
            return Redirect::home();

        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }

    }
}
