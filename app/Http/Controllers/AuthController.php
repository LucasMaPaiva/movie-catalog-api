<?php

namespace App\Http\Controllers;

use App\Base\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends BaseController
{
    /**
     * @param LoginService $loginService
     * @param LoginRequest $loginRequest
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function login(LoginService $loginService, LoginRequest $loginRequest)
    {
        try {
            return self::successResponse(
                data: $loginService->execute($loginRequest->validated()),
                message: 'Login realizado com sucesso!'
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }
}
