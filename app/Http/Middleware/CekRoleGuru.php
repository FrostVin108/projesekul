<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRoleGuru
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Asumsikan role disimpan di auth user, misal 'role' bernilai 'guru'
        if (auth()->check() && auth()->user()->role === 'guru') {
            return $next($request);
        }

        // Jika bukan guru dan metode HTTP adalah post, put, delete, blok akses
        if (in_array($request->method(), ['POST', 'PUT', 'DELETE'])) {
            return response("kamu tidak pantas untuk akses ini karna kamu bukan seorang guru!", 403);
        }

        // Jika request tidak masuk kategori di atas maka lanjut
        return $next($request);
    }

}
