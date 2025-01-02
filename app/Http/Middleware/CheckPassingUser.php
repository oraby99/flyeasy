<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Enums\UserGroup;
use Closure;

class CheckPassingUser
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
        $authenticatedUser = auth()->user();

        if(!$authenticatedUser->isActive())
            return $this->notActive();

        if($authenticatedUser->group != UserGroup::USER)
            return $this->notUserGroup();

        return $next($request);
    }
}
