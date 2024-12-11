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
        $user_type = Auth::user()->user_type;
        $user_settings = UserSettings::where('id', Auth::id())->get();
        $current_setting = (!$user_settings->isEmpty()) ? $user_settings->toArray()[0] : [];
        $request->merge(['current_user' => Auth::user(), 'current_user_settings' => $current_setting]);

        if (config('custom.user_type')[$user_type] !== "Admin") {
            return response(view('components.errors.unauthorize'));
        }
        return $next($request);
    }
}