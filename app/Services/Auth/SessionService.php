<?php

namespace App\Services\Auth;

use App\Exceptions\Auth\AuthenticationFailedException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SessionService
{
    public function store(array $data): string
    {
        $user = User::query()
            ->where('email', $data['email'] ?? '')
            ->firstOrFail();

        if (! Hash::check($data['password'] ?? '', $user->getAuthPassword())) {
            throw new AuthenticationFailedException(__('auth.failed'));
        }

        return $user->createToken('JWTToken')->accessToken;
    }

    public function update(): string
    {
        auth()->user()->token()->revoke();

        return auth()->user()->createToken('JWTToken')->accessToken;
    }

    public function destroy(): void
    {
        auth()->user()->token()->revoke();
    }
}
