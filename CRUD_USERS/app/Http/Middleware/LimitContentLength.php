<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LimitContentLength
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post') || $request->isMethod('put')) {
            $maxContentLength = 1024 * 1024; // 1MB
            if (strlen($request->getContent()) > $maxContentLength) {
                return response()->json(['error' => 'Request payload too large'], Response::HTTP_REQUEST_ENTITY_TOO_LARGE);
            }
        }

        return $next($request);
    }
}

