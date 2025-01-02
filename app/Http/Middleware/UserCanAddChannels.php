<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Closure;

class UserCanAddChannels
{
    use JsonResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authenticatedUserSubscription = auth()->user()->subscription;
        if(
            ($authenticatedUserSubscription->remains_channels_count == 0 || $authenticatedUserSubscription->remains_channels_count != null) &&
            ($authenticatedUserSubscription->remains_members_count == 0 || $authenticatedUserSubscription->remains_members_count != null)
        )
            $this->failed('user_can_not_add_channels');

        return $next($request);
    }
}
