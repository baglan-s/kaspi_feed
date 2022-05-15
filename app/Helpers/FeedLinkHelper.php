<?php

namespace App\Helpers;

use App\Models\Organization;

class FeedLinkHelper
{
    const LINK_EXPORT_PREFIX = '/feed/export/';

    const LINK_IMPORT_PREFIX = '/feed/import/';

            
    /**
     * makeImportLink
     *
     * @param  mixed $hash
     * @return string
     */
    public static function makeImportLink(string $hash): string
    {
        return env('ENDPOINT_URL') . self::LINK_IMPORT_PREFIX . $hash;
    }
    
        
    /**
     * makeExportLink
     *
     * @param  mixed $hash
     * @return string
     */
    public static function makeExportLink(string $hash): string
    {
        return env('ENDPOINT_URL') . self::LINK_EXPORT_PREFIX . $hash;
    }
    
    /**
     * isUniqueHash
     *
     * @param  mixed $hash
     * @return bool
     */
    private static function isUniqueHash(string $hash): bool
    {
        return !Organization::where('hash', $hash)->first();
    }
    
    /**
     * generateUniqueLinkHash
     *
     * @param  mixed $organization
     * @return string
     */
    public static function generateUniqueLinkHash(Organization $organization): string
    {
        $hash = $organization->id . '_' .  bin2hex(random_bytes(3));

        if (self::isUniqueHash($hash)) {
            return $hash;
        }

        self::generateUniqueLinkHash($organization);
    }
}