<?php
namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray($request)
    {
        $productDetail = Product::getProductDetails($this->product_id);
        $productDetail->image = asset('images/products/'. $productDetail->image);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'order_number' => $this->order_number,
            'sku' => $this->sku,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'shipping_fees' => $this->shipping_fees,
            'status' => $this->status,
            'productDetail' => $productDetail,
            'created_at' => $this->created_at,
            'updated_At' => $this->updated_at,
        ];
    }
}
