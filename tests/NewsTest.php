<?php
/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 15/1/17
 * Time: 12:55 PM
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use App\News;
use App\User;

/**
 * Class NewsTest
 */
class NewsTest extends TestCase
{
    //use WithoutMiddleware;
     /**
     * this will test create news
     */
    public function testCreate()
    {
        // by passing authentication
        $this->withoutMiddleware();
        $response = $this->call('POST', 'news', array(
            '_token' => csrf_token(),
        ));
        $this->assertEquals(302, $response->getStatusCode());
    }

    /**
     * this will test to show the news list
     */
    public function testList()
    {
        // get all news
        $list = News::all();
        $this->visit('/')
            ->assertNotNull($list);
    }

    /**
     * this will test to delete a news
     */
    public function testDelete()
    {
        // bypassing authentication
        $this->withoutMiddleware();
        $response = $this->call('DELETE', '/news/delete/eyJpdiI6IkJha0NmMzR5UzVRUG5FekdqMmRYQ3c9PSIsInZhbHVlIjoieEdSVExxUjhzdWw1NlJxTmNSOFVVZz09IiwibWFjIjoiYzQwOWIxMjg2ZjFiODg4OTVlN2M3YmRhMmJkZjVjM2U0MmYyMWJkZmJlZGU1NzYxNjg0MTRhOTQ5OWM4ODFiOCJ9', ['_token' => csrf_token()]);
        $this->assertEquals(500, $response->getStatusCode());
        $this->seeInDatabase('news', ['news_id' => 5]);
    }

    /**
     * this will test the home page we see the welcome message in head
     */
    public function testWeSeeNews()
    {
        $this->visit('/')
            ->see('News Publications application.');
    }

    /**
     * this will test the form validation for create post
     */
    public function testCreateNewsFormValidation()
    {
        // fake user
        $user = new User(array('username' => 'testuser'));
        $this->be($user);
        $absolutePathToFile = public_path() . 'newsimages/header_rss_btn.gif';

        $this->visit('/news')
            ->attach($absolutePathToFile, 'image')
            ->type('Test Title', 'title')
            ->type('Test details news', 'details')
            ->press('Save')
            ->assertResponseOk();
    }

}