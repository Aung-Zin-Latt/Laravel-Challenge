<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTokenResource extends JsonResource
{
    public function __construct($resource, $token)
    {
        parent::__construct($resource);
        $this->additional([
            'token' => $token
        ]);
    }

    public function toArray($request)
    {
        return [
            'user' => [
                'id' => $this->id,
                'email' => $this->email
            ],
            'token' => $this->additional['token']
        ];
    }
}
