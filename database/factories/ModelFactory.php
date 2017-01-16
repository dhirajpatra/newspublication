<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Rss::class, function (Faker\Generator $faker) {
    return [
        'rss_feed_title' => 'Top News',
        'rss_feed_description' => "Subscribe to Crossover News's RSS(Really Simple Syndication) feeds to get news delivered directly to your desktop!\r\n\r\nTo view one of the Crossover News feeds in your RSS Aggregator(About RSS Aggregators): \r\n1 . Copy the URL / shortcut that corresponds to the topic that interests you . \r\n2 . Paste the URL into your reader .",
        'rss_feed_link' => '',
        'rss_feed_language' => 'English',
        'rss_feed_image_title' => 'Header RSS Button',
        'rss_feed_image_url' => 'header_rss_btn.gif',
        'rss_feed_image_link' => 'header_rss_btn.gif',
        'rss_feed_image_width' => '30',
        'rss_feed_image_height' => '30',
        'created_at' => '2017-01-15 03:38:28',
        'updated_at' => '2017-01-15 03:38:28',
    ];
});