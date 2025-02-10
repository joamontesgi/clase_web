<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key');
        $expectedApiKey = env('API_KARDEX_KEY');
        if ($apiKey !== $expectedApiKey) {
            return response()->json([
                'message' => 'Acceso denegado. Clave API incorrecta.'
            ], 403);
        }

        return $next($request);
    }
}
