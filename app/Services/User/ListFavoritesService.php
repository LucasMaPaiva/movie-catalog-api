<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\FavoritesRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ListFavoritesService
{

    /**
     * @param int $id
     * @return mixed
     */
    public function execute(int $id)
    {
       return app(FavoritesRepository::class)->listFavoritesByUserId($id);
    }
}
