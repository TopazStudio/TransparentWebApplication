<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use App\Util\CRUD\HandlesCRUDRequest;


class RegisterController extends Controller
{
    use HandlesCRUDRequest;

    /**
     * Create a new controller instance.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
//        $this->middleware('guest');
        $this->CRUDService = $userService;

        $this->addValidationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|max:191'
        ];

        $this->updateValidationRules = [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
        ];
    }


}
