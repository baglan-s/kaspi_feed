<?php

namespace App\Helpers\ValidationRules;


class UserValidationRule
{
    public static function createRule(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'api_token' => 'string'
        ];
    }

    public static function updateRule(int $user_id): array
    {
        return [
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $user_id,
            'password' => 'confirmed',
        ];
    }

    public static function loginRule(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}