<?php

namespace App\Http\Resources;

class AuthUserResource extends UserResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            'email' => $this->resource->email,
            'has_verified_email' => $this->resource->hasVerifiedEmail(),
        ]);
    }
}
