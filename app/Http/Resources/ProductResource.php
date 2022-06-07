<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
Use Carbon\Carbon as Time;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => 'SingleProduct',
            "data" => [
                'id' => $this->id,
                'name' => $this->name,
                'name_bn' => $this->name_bn,
                'sub_name' => $this->sub_name,
                'sub_name_bn' => $this->sub_name_bn,
                'slug' => $this->slug,
                'slug_bn' => $this->name_bn,
                'category_id' => $this->category_id,
                'price' => $this->price,
                'image' => $this->image,
                'image_type' => $this->image_type,
                'description' => $this->description,
                'discount_amount' => $this->discount_amount,
                'discount_percentage' => $this->discount_percentage,
                'sale_price' => $this->sale_price,
                'special_offer' => $this->special_offer,
                'special_image' => $this->special_image,
                'special_image_type' => $this->special_image_type,
                'quantity' => $this->quantity,
                'unit_id' => $this->unit_id,
                'status' => $this->status,
                'meta_title' => $this->meta_title,
                'meta_tags' => $this->meta_tags,
                'meta_description' => $this->meta_description,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'time' => Time::now()->toRfc850String()
            ],
            "pcat" => null
        ];
    }
}
