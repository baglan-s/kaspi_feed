<?php

namespace App\Helpers\ValidationRules;

class FeedRule
{
    public static function importRule(): array
    {
        return [
            'file' => 'required|file|mimes:xml',
            'description' => 'string',
        ];
    }
}