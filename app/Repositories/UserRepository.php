<?php

namespace App\Repositories;



use App\Base\Repository\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{

    public function __construct() {
        $this->setModel(User::class);
    }
}
