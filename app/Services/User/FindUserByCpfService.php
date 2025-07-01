<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FindUserByCpfService
{
    /**
     * @param string $email
     * @return User
     */
    public function execute(string $email): User
    {
        $user = app(UserRepository::class)->findByColumn('email', $email);
        if (!$user) {
            throw new ModelNotFoundException('Usuário não encontrado');
        }
        return $user;
    }
}
