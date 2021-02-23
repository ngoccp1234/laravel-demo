<?php

namespace App\Http\Middleware;

use App\Enums\CommonStatus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class LogUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * before middleware
         */
//        $categories = [];
//        View::share('categories', $categories);
//        if (Auth::user() -> status != CommonStatus::ACTIVE)
//        {
//            return response()-> json(['message' => 'bi ban roi']);
//        }
//        Log::info(Auth::user() -> email);
//        return $next($request);

        /**
         * After middleware
         */
        $res = $next($request);
        return response()->json([
            'status' => '1',
            'data' => $res->original
        ]);
    }
}
