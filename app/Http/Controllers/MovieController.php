<?php

namespace App\Http\Controllers;

use App\Base\Http\Controllers\BaseController;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends BaseController
{


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function showPopular(Request $request)
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
    public function showTopRated(Request $request)
    {
        {
            try {
                $response = $this->fetchFromApi($request, 'movie/top_rated');
                return response()->json($response->json());
            } catch (ConnectionException $connectionException) {
                return response()->json(['error' => 'Erro ao acessar a API'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchMovie(Request $request)
    {
        try {
            $response = $this->fetchFromApi($request, 'search/movie');

            return response()->json($response->json());
        } catch (ConnectionException $connectionException) {
            return response()->json(['error' => 'Erro ao acessar a API'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
