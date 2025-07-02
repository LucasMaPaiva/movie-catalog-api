<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\FavoritesRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserFavoriteService
{

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function execute(int $id, array $data)
    {
       return app(FavoritesRepository::class)->create([
           'movie_id' => $data['movie_id'],
           'user_id' => $id,
           'movie_details' => $data['movie_details'],
       ]);
    }
}
