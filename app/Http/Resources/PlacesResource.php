<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlacesResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'orientationImg' => $this->orientationImg,
            'disabilities' => $this->disabilities,
            'img' => $this->img,
            'subcategoryId' => $this->subcategoryId,
            // 'locationId' => $this->locationId,

            'location' => $this->location ? [
                'id' => $this->location->id,
                'name' => $this->location->name,
                'point' => $this->location->point,
                'address' => $this->location->address,
                'img' => $this->location->img,
            ] : null, // Возвращаем null, если location отсутствует

            'routes' => $this->routes->map(function ($route) {
                return [
                    'id' => $route->id,
                    'name' => $route->name,
                    'pointStart' => $route->pointStart,
                    'pointEnd' => $route->pointEnd,
                    'agency' => [
                        'id' => $route->agency->id ?? null,
                        'name' => $route->agency->name ?? null,
                        'phones' => $route->agency->phones ?? null,
                    ],
                ];
            }),
            'attributes' => $this->attributes->map(function ($attribute) {
                return [
                    'id' => $attribute->id,
                    'name' => $attribute->name,
                    'img' => $attribute->img,
                ];
            }),
            'organisations' => $this->organisations->map(function ($organisation) {
                return [
                    'id' => $organisation->id,
                    'name' => $organisation->name,
                    'phones' => $organisation->phones,   
                    'link' => $organisation->link,                 
                ];
            }),

        ];
    }
}
