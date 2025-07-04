<?php

namespace App\Http\Middleware;

use App\Base\Traits\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware {

    use Response;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string {
        return self::notAuthorizeExceptionResponse();
    }
}
