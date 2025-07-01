<?php

namespace App\Services\User;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FindUserByCpfService
{
    public function execute(string $cpf)
    {
        $user = app(UserRepository::class)->findByCpf($cpf);

        if (!$user) {
            throw new ModelNotFoundException('Usuário não encontrado');
        }
        return $user;
    }
}
