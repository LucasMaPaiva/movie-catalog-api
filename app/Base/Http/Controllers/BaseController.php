<?php

namespace App\Base\Http\Controllers;

use App\Base\Traits\AuditLog;
use App\Base\Traits\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

class BaseController extends Controller
{

    use AuditLog, ValidatesRequests, AuthorizesRequests, Response;

    public function fetchFromApi(Request $request, string $url)
    {
        try {

            $page = $request->query('page', 1);
            $language = $request->query('language', config('app.fallback_locale'));
            $query = $request->query('query');
            $apiKey = config('movie_catalog.integrations.api_key');

            $params = [
                'api_key' => $apiKey,
                'language' => $language,
                'page' => $page,
            ];

            if ($query) {
                $params['query'] = $query; // só adiciona se for necessário
            }


//            return Http::get(config('movie_catalog.integrations.api_base_url') . $url, $params);

            return Http::get(config('movie_catalog.integrations.api_base_url') . $url, $params);



        } catch (ConnectionException) {
            return response()->json(['error' => 'Erro ao acessar a API do TMDB'], ResponseCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
