<?php

namespace App\Http\Controllers;

use App\Base\Http\Controllers\BaseController;
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
     * @return JsonResponse|Response
     */
    public function favoriteMovie(int $id, UserFavoriteRequest $data, UserFavoriteService $userFavoriteService)
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
     * @return JsonResponse|Response
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
     * @param Request $request
     * @return JsonResponse|string
     */
    public function removeFavorite(int $id, RemoveFavoriteService $removeFavoriteService, Request $request)
    {
        try {
            $data = $request->validate([
                'movie_id' => 'required|integer'
            ]);

            return self::successResponse(
                data: $removeFavoriteService->execute($id, (int) $data['movie_id']),
                message: 'Filme removido como favorito',
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }


}
