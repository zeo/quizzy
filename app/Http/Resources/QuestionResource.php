<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read \App\Models\Question $resource
 */
class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'time_seconds' => $this->resource->time_seconds,
            'order' => $this->resource->order,
            'answers' => AnswerResource::collection($this->whenLoaded('answers')),
        ];
    }
}
