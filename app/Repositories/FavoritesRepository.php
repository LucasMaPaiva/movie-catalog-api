<?php

namespace App\Repositories;



use App\Base\Repository\BaseRepository;
use App\Models\Favorites;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FavoritesRepository extends BaseRepository
{

    public function __construct() {
        $this->setModel(Favorites::class);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function listFavoritesByUserId(int $id)
    {
        $result = DB::selectOne("
        SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
                'id', id,
                'movie_id', movie_id,
                'user_id', user_id,
                'movie_details', movie_details,
                'created_at', created_at,
                'updated_at', updated_at
            )
        ) AS favorites
        FROM favorites
        WHERE user_id = ?
    ", [$id]);

        return json_decode($result->favorites, true);
    }

    /**
     * @param $id
     * @param $movie_id
     * @return array
     */
    public function findFavorite($id, $movie_id)
    {
        return DB::selectOne(
            "SELECT *
         FROM favorites
         WHERE user_id = ?
         AND movie_id = ?",
            [$id, $movie_id]
        );
    }

}
