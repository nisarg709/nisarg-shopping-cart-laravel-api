<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /* login*/
    /**
     * @throws ValidationException
     */
    public function login(Request $request)
    {

        $this->validateRequest('login');
        $credentials = $request->only(['email', 'password']);

        $users = User::whereEmail($credentials['email'])->first();

        if ($users) {

            if ($users->status === 'inactive') {
                $failMsg = 'user_is_inactive';
                return Controller::successFailResponse($failMsg, Controller::$FAIL);
            }

            if (Hash::check($credentials['password'], $users->password) == false) {
                $failMsg = 'email_and_password_not_match';
                return Controller::successFailResponse($failMsg, Controller::$FAIL);
            }

            $token = $this->generateAccessToken($users);
            return UserResource::make($users)->additional(['meta' => [
                'token' => $token,
                'status' => Controller::$SUCCESS,
                'message' => Lang::get('validation.login_success'),
            ]]);

        } else {
            $failMsg = 'email_not_registered_with_us';
            return Controller::successFailResponse($failMsg, Controller::$FAIL);
        }

    }
}
