<?php
declare(strict_types=1);
namespace App\Http\Middleware;

use App\Models\UserSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdminWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_type = Auth::user()->access_type;
        $request->merge(['current_user' => Auth::user()]);

        if (config('users.admin') !== $user_type) {
            return response(view('components.errors.unauthorize'));
        }
        return $next($request);
    }
}