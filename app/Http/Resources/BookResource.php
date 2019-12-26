<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public static $wrap = null;


    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'production_year' => $this->production_year,
            'price' => $this->price,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'authors' => $this->authors
        ];
    }
}
