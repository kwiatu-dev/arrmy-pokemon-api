<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperSecretKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $providedKey = $request->header('X-SUPER-SECRET-KEY');
        $validKey = env('SUPER_SECRET_KEY');

        if (!$providedKey || $providedKey !== $validKey) {
            return response()->json([
                'message' => 'Unauthorized. Invalid or missing X-SUPER-SECRET-KEY.'
            ], 401);
        }

        return $next($request);
    }
}
