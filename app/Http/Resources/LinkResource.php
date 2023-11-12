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
        $isOwner = auth()->check() && auth()->user()->getAuthIdentifier() === $this->user_id;

        return [
            'url' => $this->url,
            'identifier' => $this->identifier,
            'clicks' => $isOwner ? $this->clicks : round($this->clicks, -1),
            'expires_at' => $this->expires_at,
            'duration' => $this->when($isOwner, $this->duration),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}