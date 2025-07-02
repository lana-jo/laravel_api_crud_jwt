<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class middlewareJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // // Jika user belum login
        // if (!auth()->check()) {
        //     // Jika request dari API
        //     if ($request->expectsJson()) {
        //         return response()->json(['message' => 'Unauthorized'], 401);
        //     }

        //     // Jika request dari Web (redirect)
        //     return redirect()->route('login');
        // }

        try {
            // Validasi JWT token dari Authorization: Bearer <token>
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid or missing token',
                'error' => $e->getMessage()
            ], 401);
        }
        // Jika user sudah login, lanjutkan
        return $next($request);
        // return $next($request);
    }
}
