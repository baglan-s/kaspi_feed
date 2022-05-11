<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\UserTrait;
use App\Helpers\ValidationRules\UserValidationRule;
use App\Http\Resources\SuccessStatusResource;
use App\Http\Resources\EntityNotFoundResource;

class UserController extends Controller
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

    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function create(Request $request)
    {
        $user = $this->createUser( $this->validate($request, UserValidationRule::createRule()) );

        return new UserResource($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->update($this->validate($request, UserValidationRule::updateRule($id)))) {
            return new SuccessStatusResource(null);
        }

        return new EntityNotFoundResource(null);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return new SuccessStatusResource(null);
        }

        return new EntityNotFoundResource(null);
    }
}
