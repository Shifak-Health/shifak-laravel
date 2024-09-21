<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Admin */
class PharmacyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'hotline' => $this->hotline,
            'avatar' => $this->image,
            'is_active' => $this->is_active,
            'logo' => $this->getFirstMediaUrl('logo'),
            'user_id' => $this->user_id,
            'is_accept_expired' => $this->is_accept_expired,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
