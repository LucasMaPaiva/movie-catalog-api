<?php

namespace App\Http\Controllers;

use App\Base\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{

    /**
     * @param RegisterService $registerService
     * @param RegisterRequest $data
     * @return JsonResponse
     */
    public function register(RegisterService $registerService, RegisterRequest $data) {
        try {
            return self::successResponse(
                data: $registerService->execute($data->validated()),
                message: 'Login realizado com sucesso!'
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }

    /**
     * @param LoginService $loginService
     * @param LoginRequest $data
     * @return JsonResponse|
     */
    public function login(LoginService $loginService, LoginRequest $data)
    {
        try {
            return self::successResponse(
                data: $loginService->execute($data->validated()),
                message: 'Login realizado com sucesso!'
            );
        } catch (Exception $exception) {
            return self::returnError($exception);
        }
    }
}
