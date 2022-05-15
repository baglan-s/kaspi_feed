<?php

namespace App\Http\Controllers;

use App\Helpers\ValidationRules\UserValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Traits\UserTrait;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    use UserTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $request)
    {
        if ($user = $this->attempt($this->validate($request, UserValidationRule::loginRule()))) {
            if ($userWithNewToken = $this->setUserToken($user)) {
                return new UserResource($userWithNewToken);   
            }
        };

        return response()->json([
            'message' => 'Incorrect login or password',
        ], 401);
    }

    public function register(Request $request)
    {
        $user = $this->createUser( $this->validate($request, UserValidationRule::createRule()) );

        return new UserResource($user);
    }

    public function authenticated()
    {
        return new UserResource(Auth::user());
    }

    public function logout()
    {
        if ($user = User::find(Auth::user()->id)) {
            $this->removeUserToken($user);

            return response()->json([
                'success' => true,
            ]);
        }
    }
}
