<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\WastePartCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ChallengeResource extends JsonResource
{
    private bool $light;

    public function __construct($resource, bool $light = false)
    {
        parent::__construct($resource);
        $this->light = $light;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'content' => $this->resource->content,
            'points' => $this->resource->points,
            'startedAt' => $this->resource->started_at,
            'endedAt' => $this->resource->ended_at,
        ];

        if(!$this->light) {
            $additionalData = [
                'participations' => $this->resource->users
            ];
            $data = array_merge($data, $additionalData);
        }

        return $data;
    }
}
