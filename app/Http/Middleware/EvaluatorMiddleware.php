<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EvaluatorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->hasRole('evaluator')) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.'); // atau redirect ke halaman lain jika perlu
    }
}
