<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'discount' => $this->discount,
            'stock' => $this->stock == 0 ? 'Out Of Stock' : $this->stock,
            'totalPrice' => round((1-($this->discount/100))*$this->discount,2)
       ];
    }
}
