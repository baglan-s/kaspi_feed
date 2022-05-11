<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait UserTrait 
{

    public function createUser(array $data)
    {
        $data['api_token'] = $this->generateUniqueToken();
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    public function generateUniqueToken()
    {
        $token = bin2hex(random_bytes(32));

        if (!User::where('api_token', $token)->first()) {
            return $token;
        }

        $this->generateUniqueToken();
    }

    public function setUserToken(User $user): User
    {
        $user->api_token = $this->generateUniqueToken();

        if ($user->save()) {
            return $user;
        }

        return new User;
    }

    public function attempt(array $credentials)
    {
        if (!$user = User::where('email', $credentials['email'])->first()) {
            return false;
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return false;
        }

        return $user;
    }

    public function removeUserToken(User $user): bool
    {
        return $user->update(['api_token' => null]);
    }
}