<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'url' => $this->url,
            'identifier' => $this->identifier,
            'clicks' => $this->clicks,
            'expires_at' => $this->expires_at,
            'duration' => $this->duration,
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
