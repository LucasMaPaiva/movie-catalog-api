<?php

namespace App\Http\Controllers;

use App\Base\Http\Controllers\BaseController;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GenreController extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            return response()->json(($this->fetchFromApi($request, 'genre/movie/list'))->json());
        } catch (ConnectionException $connectionException) {
            return response()->json(['error' => 'Erro ao acessar a API'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
