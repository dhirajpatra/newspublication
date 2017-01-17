<?php

/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 15/1/17
 * Time: 1:10 PM
 */
use App\User;

/**
 * Class UserTest
 */
class UserTest extends TestCase
{
    /**
     * This will test registration
     */
    public function testNewUserRegistration()
    {
        $this->visit('/register')
            ->type('Crossover', 'username')
            ->type('crossover@test.com', 'email')
            ->type('test123', 'password')
            ->type('test123', 'password_confirmation')
            ->press('signup')
            ->seePageIs('/');
    }

    /**
     * this will test login
     */
    public function testLogin()
    {
        $user = User::first();
        $this->be($user);
    }
}