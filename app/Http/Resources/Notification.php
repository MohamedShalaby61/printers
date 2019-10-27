<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Notification extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request,$lang)
    {
        return [
            'id' => $this->id,
            'order_id'=>$this->order_id,
            'data' => $lang == 'ar' ? $this->data_ar : $this->data_en,
            'title'=> $lang == 'ar' ? $this->title_ar : $this->title_en,
        ];
    }
}