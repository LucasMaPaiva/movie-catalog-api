<?php

namespace App\Http\Controllers;

use App\Base\Http\Controllers\BaseController;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends BaseController
{


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function showPopular(Request $request): JsonResponse
    {
        try {

            return response()->json(($this->fetchFromApi($request, 'movie/popular'))->json());

        } catch (ConnectionException $connectionException) {
            return response()->json(['error' => 'Erro ao acessar a API'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function showTopRated(Request $request): JsonResponse
    {
        {
            try {
                return response()->json(($this->fetchFromApi($request, 'movie/top_rated'))->json());
            } catch (ConnectionException $connectionException) {
                return response()->json(['error' => 'Erro ao acessar a API'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchMovie(Request $request): JsonResponse
    {
        try {
            return response()->json(($this->fetchFromApi($request, 'search/movie'))->json());
        } catch (ConnectionException $connectionException) {
            return response()->json(['error' => 'Erro ao acessar a API'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
