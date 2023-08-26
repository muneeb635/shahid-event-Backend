<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RevenueResource extends JsonResource
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
            'hall' => $this->hall,
            'date' => $this->date,
            'marque_revenue' => $this->marque_revenue,
            'owner_revenue' => $this->owner_revenue,
            'partner_revenue' => $this->partner_revenue,
        ];
    }
}
