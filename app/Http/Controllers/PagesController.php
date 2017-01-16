<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PagesController extends BaseController
{
    /**
     * @return mixed
     */
    public function home()
    {
        $newsObj = new News();
        $newsList = $newsObj->listNews(10);
        //echo "<pre>"; print_r($newsList); exit;
        return View::make('pages.home', ['newsList' => $newsList]);
    }

}
