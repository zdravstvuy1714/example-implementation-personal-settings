<?php

namespace App\Services\Auth;

use App\Models\User;

class RegistrationService
{
    public function store(array $data, ?bool $authenticate = false): array
    {
        $user = User::query()->create($data);

        if ($authenticate) {
            $token = $user->createToken('JWTToken')->accessToken;

            return ['token' => $token];
        }

        return ['id' => $user->id];
    }
}
