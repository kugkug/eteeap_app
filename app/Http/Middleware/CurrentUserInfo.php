<?php

namespace App\Http\Middleware;

use App\Models\UserSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CurrentUserInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id = Auth::id();
        // $user_settings = UserSettings::where('user_id', $user_id)->get();
        // $current_setting = (!$user_settings->isEmpty()) ? $user_settings->toArray()[0] : [];
        $request->merge(['current_user' => Auth::user()]);
        
        return $next($request);
    }
}