<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\User\FindUserByCpfService;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class LoginService
{

    /**
     * @param array $data
     * @return array
     */
    public function execute(array $data)
    {
        $user = app(FindUserByCpfService::class)->execute(
            email: $data['email'],
        );

        $this->checkIfCanAccess(
            password: $data['password'],
            user: $user
        );

        $token = $this->generateToken($user);
        return [
            'access_token' => $token,
            'user' => $user,
        ];
    }

    /**
     * @param string $password
     * @param User $user
     * @return void
     */
    private function checkIfCanAccess(string $password, User $user) :void
    {
        if (str_starts_with($user->password, '$2a$06$')) {
            $user->password = Hash::make($password);
            $user->save();
        }

        if (!$user || !Hash::check($password, $user->password)) {
            throw new InvalidArgumentException('Usuário não encontrado');
        }
    }

    /**
     * @param $user
     * @return mixed
     */
    private function generateToken($user): mixed
    {
        return $user->createToken(
            name: 'access_token',
            abilities: []
        )->plainTextToken;
    }
}
