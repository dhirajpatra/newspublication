<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Mail\Mailer;
use Mail;
use Hash;
use Flash;
use App\User;
use Mockery\Exception;

/**
 * Class RegistrationController
 * @package App\Http\Controllers
 */
class RegistrationController extends BaseController
{
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        try {
            $this->mailer = $mailer;
            Redirect('guest');
        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }

    }
    /**
     * Show a form to register the user.
     *
     * @return Response
     */
    public function create()
    {
        try{
            return View::make('registration.create');
        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }

    }
    /**
     * Create a new forum member.
     *
     * @return Response
     */
    public function store()
    {
        try{
            $rules = [
                'username' => 'required|min:6|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6'
            ];
            $validator = Validator::make(Input::only('username', 'email', 'password', 'password_confirmation'), $rules);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            // confirmation code for validation
            $confirmation_code = hash_hmac('sha256', str_random(40), config('app.key'));
            User::create([
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'password' => Hash::make(Input::get('password')),
                'confirmation_code' => $confirmation_code,
            ]);

            Mail::send('emails.verify', compact('confirmation_code'), function($message) {
                $message->to(Input::get('email'), Input::get('username'))->subject('Verify your email address');
            });
            Flash::message('Thanks for signing up! Please check your email and follow the instructions to complete the sign up process');
            return Redirect::home();

        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }

    }
    /**
     * Attempt to confirm a users account.
     *
     * @param $confirmation_code
     *
     * @throws InvalidConfirmationCodeException
     * @return mixed
     */
    public function confirm($confirmation_code)
    {
        try{
            if( ! $confirmation_code)
            {
                return Redirect::home();
            }
            $user = User::whereConfirmationCode($confirmation_code)->first();
            if ( ! $user)
            {
                return Redirect::home();
            }
            $user->confirmed = 1;
            $user->confirmation_code = null;
            $user->save();
            Flash::message('You have successfully verified your account. You can now login.');
            return Redirect::route('login_path');
        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }

    }
}
