<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Document extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            "document_id" => $this->document_id,
            "document_name" => $this->document_Name,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "user_id" => $this->whenLoaded('user_id'),
        ];
    }
}
