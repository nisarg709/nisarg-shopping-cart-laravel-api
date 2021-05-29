<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class UserResource extends JsonResource
{

    public function toArray($request){

        return  [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'role' => $this->role,
            'language' => $this->language,
            'currency' => $this->currency,
            'created_at' => $this->created_at,
            'updated_At' => $this->updated_at,
        ];
    }
}
