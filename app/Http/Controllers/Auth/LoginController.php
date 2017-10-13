<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | NOTE: removed guest middleware to avoid redirecting to '/home'
    |
    */

    use AuthenticatesUsers;

    /**
     * Token that should be sent on authentication of user
     *
     * */
    protected $token;

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        try {
            if (! $this->token = JWTAuth::attempt($this->credentials($request))) {
                return false;
            }
        } catch (JWTException $e) {
            return false;
        }
        return true;
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return $this->successResponse(['token'=>$this->token,'user'=>$user->load('pictures')]);
    }
}
