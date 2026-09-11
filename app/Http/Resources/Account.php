<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Account extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            "account_id" => $this->account_id,
            "email" => $this->email,
            "password" => $this->password,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "user_id" => $this->whenLoaded('user'),
            "credit_id" => $this->whenLoaded('credit_id'),
            "document_id" => $this->whenLoaded('document_id'),
        ];
    }
}
