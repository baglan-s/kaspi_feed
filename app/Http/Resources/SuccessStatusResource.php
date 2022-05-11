<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class SuccessStatusResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'succes' => true
        ];
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request
     * @param  \Illuminate\Http\Response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode(200, 'Success');
    }
}