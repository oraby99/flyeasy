<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Enums\UserGroup;
use Closure;

class CheckAuthAdmin
{
    use JsonResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check() || !auth()->user()->group == UserGroup::ADMIN)
            return redirect(route('dashboard.auth.login'));

        return $next($request);
    }
}
