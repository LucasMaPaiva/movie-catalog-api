<?php

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function execute(array $data)
    {
        return app(UserRepository::class)->create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]
        );
    }
}
