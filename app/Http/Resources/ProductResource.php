<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'category' => $this->category,
            'sub_category' => $this->sub_category,
            'price' => $this->price,
            'description' => $this->description,
            'image' => asset('images/products/'. $this->image),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_At' => $this->updated_at,
        ];
    }
}
