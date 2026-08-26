<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->role !== 'admin') {
            abort(403, 'Acesso negado. Você não tem permissão para acessar esta página.');
        }
        return $next($request);
    }
}
