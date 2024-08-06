<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StockMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Vérifie si l'en-tête 'CLE-UNIQUE' est présent dans la requête
         if (!$request->hasHeader('CLE-UNIQUE')) {
            return response()->json(['erreur' => 'Action impossible!'], 403);
        }

        return $next($request);
    }
}
