<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class LogUserVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->header('User-Agent');
        $ipAddress = $request->ip();

        DB::table('access')->insert([
            'operating' => $userAgent,
            'ip' => $ipAddress,
        ]);

        return $next($request);
    }
}
