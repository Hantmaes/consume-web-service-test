<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ico extends JsonResource
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
            'id'=> $this->id,
            'ares_firma_fin' => $this->ares_firma_fin,
            'ares_ulice_fin' => $this->ares_ulice_fin,
            'ares_mesto_fin' => $this->ares_mesto_fin,
            'ares_psc_fin' => $this->ares_psc_fin,
            'ares_ico_fin' => $this->ares_dic_fin,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('Y/m/d'),
        ];
    }
}
