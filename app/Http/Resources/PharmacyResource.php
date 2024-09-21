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
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->Pharmacy_name,
            'hotline' => $this->hotline,
            'avatar' => $this->image,
        ];
    }
}
