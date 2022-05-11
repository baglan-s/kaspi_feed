<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class EntityNotFoundResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'message' => 'Entity Not Found!'
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
        $response->setStatusCode(404, 'Entity Not Found!');
    }
}