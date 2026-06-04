<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleExceptions
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (\Exception $e) {
            // Log error
            \Log::error('Exception: ' . $e->getMessage());

            // Return JSON error for API/webhook requests
            if ($request->is('payment/*') || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Internal server error',
                ], 500);
            }

            throw $e;
        }
    }
}