<?php

namespace App\Helpers;

use App\Models\Organization;

class FeedLinkHelper
{
    const LINK_EXPORT_PREFIX = '/feed/export.php?code=';

    const LINK_IMPORT_PREFIX = '/feed/import/';

            
    /**
     * makeImportLink
     *
     * @param  mixed $code
     * @return string
     */
    public static function makeImportLink(string $code): string
    {
        return env('ENDPOINT_URL') . self::LINK_IMPORT_PREFIX . $code;
    }
    
        
    /**
     * makeExportLink
     *
     * @param  mixed $code
     * @return string
     */
    public static function makeExportLink(string $code): string
    {
        return env('ENDPOINT_URL') . self::LINK_EXPORT_PREFIX . $code;
    }
    
    /**
     * isUniquecode
     *
     * @param  mixed $code
     * @return bool
     */
    private static function isUniqueCode(string $code): bool
    {
        return !Organization::where('code', $code)->first();
    }
    
    /**
     * generateUniqueLinkcode
     *
     * @param  mixed $organization
     * @return string
     */
    public static function generateUniqueLinkCode(Organization $organization): string
    {
        $code = $organization->id . '_' .  bin2hex(random_bytes(3));

        if (self::isUniqueCode($code)) {
            return $code;
        }

        self::generateUniqueLinkCode($organization);
    }
}