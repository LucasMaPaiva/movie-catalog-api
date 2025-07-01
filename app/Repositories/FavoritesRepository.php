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
     * @param $genreIdsArray
     * @return array|mixed
     */
    public function listFavoritesByUserId(int $id, $genreIdsArray)
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

        $favorites = json_decode($result->favorites, true) ?? [];

        if (!empty($genreIdsArray)) {
            $favorites = array_filter($favorites, function ($fav) use ($genreIdsArray) {
                $movieDetails = json_decode(json_encode($fav['movie_details']), true);
                $movieGenreIds = $movieDetails['genre_ids'] ?? [];

                return count(array_intersect($genreIdsArray, $movieGenreIds)) > 0;
            });

            $favorites = array_values($favorites);
        }
        return $favorites;
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
