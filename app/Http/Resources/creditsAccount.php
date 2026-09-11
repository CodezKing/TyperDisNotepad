<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class creditsAccount extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
          "credit_id" => $this->credit_id,
          "amount" => $this->amount,
          "user_id" => $this->user_id,
          "account_id" => $this->account_id,
        ];
    }
}
