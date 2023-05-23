<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IPWhitelistMiddleware
{
    public function handle($request, Closure $next)
    {
        $allowedIPs = [
            '192.168.0.1', // Tambahkan daftar alamat IP yang diperbolehkan di sini
            '10.0.0.1',
        ];

        $clientIP = $request->ip();

        if (!in_array($clientIP, $allowedIPs)) {
            return response('Forbidden', 403);
        }

        return $next($request);
    }
}
