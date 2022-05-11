<?php

namespace App\Helpers\ValidationRules;

class OrganizationRule
{
    public static function createRule(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'string',
        ];
    }

    public static function updateRule(): array
    {
        return [
            'name' => 'string|max:255',
            'description' => 'string',
        ];
    }
}