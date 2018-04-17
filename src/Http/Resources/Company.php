<?php

namespace Betalabs\LaravelHelper\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Company extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'trading_name' => $this->trading_name,
            'email' => $this->email,
            'cnpj' => $this->cnpj,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'deleted_at' => (string)$this->deleted_at,
            'access_token' => $this->when(
                !empty($this->accessToken),
                $this->accessToken
            )
        ];
    }
}
