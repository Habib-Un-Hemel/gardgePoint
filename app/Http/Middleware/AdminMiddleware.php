<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Session::get('is_admin')) {
            return redirect('/admin/login')->with('error', 'You must be logged in as admin.');
        }

        return $next($request);
    }
}
