<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'media_title' => $this->media_title,
            'entry_title' => $this->entry_title,
            'entry_author' => $this->entry_author,
            'entry_url' => $this->entry_url,
        ];
    }
}
