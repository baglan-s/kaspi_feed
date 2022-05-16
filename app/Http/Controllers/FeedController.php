<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Helpers\ValidationRules\FeedRule;
use App\Http\Resources\EntityNotFoundResource;
use App\Http\Resources\SuccessStatusResource;
use App\Http\Resources\ServerErrorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedController extends Controller
{
    const FILE_DIR = 'feed/';
    
    /**
     * import
     *
     * @param  mixed $request
     * @param  mixed $code
     * @return JsonResource
     */
    public function import(Request $request, string $code): JsonResource
    {
        $this->validate($request, FeedRule::importRule());
        
        if (!$organization = Organization::where('code', $code)->first()) {
            return new EntityNotFoundResource(null);
        }

        $fileName = $organization->id . '_' . date('Y-m-d_H-i-s') . '.xml';
        $newFilePath = self::FILE_DIR . $fileName;

        if ($organization->feed_path && file_exists($organization->feed_path)) {
            unlink($organization->feed_path);
        }

        $request->file('file')->move(self::FILE_DIR, $fileName);
        
        if ($organization->update(['feed_path' => $newFilePath])) {
            return new SuccessStatusResource(null);
        }

        return new ServerErrorResource(null);
    }
    
    /**
     * export
     *
     * @param  mixed $code
     * @return mixed
     */
    public function export(string $code): mixed
    {
        $organization = Organization::where('code', $code)->first();

        if ($organization && $organization->feed_path && file_exists($organization->feed_path)) {
            return response(file_get_contents($organization->feed_path), 200, ['Content-Type' => 'application/xml']);
        }

        return new EntityNotFoundResource(null);
    }
}