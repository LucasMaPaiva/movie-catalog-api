<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\FavoritesRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RemoveFavoriteService
{

    /**
     * @param int $id
     * @param int $movie_id
     * @return void
     */
    public function execute(int $id, int $movie_id): void
    {
       $movie_favorite =  app(FavoritesRepository::class)->findFavorite($id, $movie_id);
        app(FavoritesRepository::class)->delete($movie_favorite->id);

    }
}
