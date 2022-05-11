<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class ServerErrorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'message' => 'Internal server error!'
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
        $response->setStatusCode(500, 'Internal server error!');
    }
}