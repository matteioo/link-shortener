<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // check if user is authenticated and the owner of the Link
        $isOwner = auth()->check() && auth()->user()->getAuthIdentifier() === $this->user_id;

        // dd($isOwner);

        return [
            'url' => $isOwner ? $this->url : null,
            'identifier' => $this->identifier,
            'clicks' => $isOwner ? $this->clicks : round($this->clicks, -1),
            'expires_at' => $this->expires_at,
            'duration' => $this->duration,
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
