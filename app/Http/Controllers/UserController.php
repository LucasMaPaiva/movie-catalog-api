<?php

namespace App\Http\Controllers;

use App\Base\Http\Controllers\BaseController;
use App\Http\Requests\User\RemoveFavoriteRequest;
use App\Http\Requests\User\UserFavoriteRequest;
use App\Services\User\ListFavoritesService;
use App\Services\User\RemoveFavoriteService;
use App\Services\User\UserFavoriteService;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{


    /**
     * @param int $id
     * @param UserFavoriteRequest $data
     * @param UserFavoriteService $userFavoriteService
     * @return JsonResponse
     */
    public function favoriteMovie(int $id, UserFavoriteRequest $data, UserFavoriteService $userFavoriteService): JsonResponse
    {
        try {
            return self::successResponse(
                data: $userFavoriteService->execute($id, $data->validated()),
                message: 'Filme registrado como favorito',
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }

    /**
     * @param int $id
     * @param ListFavoritesService $listFavoritesService
     * @return JsonResponse
     */
    public function listFavorite(int $id, ListFavoritesService $listFavoritesService)
    {
        try {
            return self::successResponse(
                data: $listFavoritesService->execute($id),
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }

    /**
     * @param int $id
     * @param RemoveFavoriteService $removeFavoriteService
     * @param RemoveFavoriteRequest $data
     * @return JsonResponse
     */
    public function removeFavorite(int $id, RemoveFavoriteService $removeFavoriteService, RemoveFavoriteRequest $data): JsonResponse
    {
        try {
            $removeFavoriteService->execute($id, $data->validated()['movie_id']);
            return self::successResponse(
                message: 'Filme removido como favorito',
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }


}
