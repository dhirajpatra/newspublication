<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Mockery\Exception;

/**
 * Class BaseController
 * @package App\Http\Controllers
 */
class BaseController extends Controller {
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        try {
            if ( ! is_null($this->layout)) {
                $this->layout = View::make($this->layout);
            }
            View::share('currentUser', Auth::user());
        } catch (Exception $e) {
            Flash::message('Something went wrong');
        }

    }
}
