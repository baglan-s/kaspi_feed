<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\FeedLinkHelper;


class OrganizationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'import_link' => FeedLinkHelper::makeImportLink($this->hash),
            'export_link' => FeedLinkHelper::makeExportLink($this->hash),
        ];
    }
}