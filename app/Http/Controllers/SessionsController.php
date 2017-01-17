<?php

namespace App\Http\Controllers;

use Auth;
use Flash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

/**
 * Class SessionsController
 * @package App\Http\Controllers
 */
class SessionsController extends BaseController
{
    public function __construct()
    {
        
    }

    /**
     * Show the login form.
     * GET /sessions/create
     *
     * @return Response
     */
    public function create()
    {
        try {
            return View::make('sessions.create');
        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }
    }

    /**
     * Attempt to log a user in
     * POST /sessions
     * @return Response
     */
    public function store()
    {
        try {
            $rules = [
                'username' => 'required|exists:users',
                'password' => 'required'
            ];

            $validator = Validator::make(Input::only('username', 'email', 'password'), $rules);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $credentials = [
                'username' => Input::get('username'),
                'password' => Input::get('password'),
                'confirmed' => 1
            ];

            $remember = Input::get('remember');
            if ( ! Auth::attempt($credentials, $remember) ) {
                return Redirect::back()->withInput()->withErrors(['credentials' => 'We were unable to sign you in']);
            }
            \Session::flash('msg','Welcome back!');
            return Redirect::home();

        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }
    }

    /**
     * log a user out
     * @return mixed
     */
    public function destroy()
    {
        try {
            Auth::logout();
            return Redirect::home();
        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }
    }
}
