<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class SubcategoryResource extends JsonResource
{

    public function toArray($request){

        return  [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'sub_category_name' => $this->sub_category_name,
            'created_at' => $this->created_at,
            'updated_At' => $this->updated_at,
        ];
    }
}
