<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Repositories\UserLinkRepository;
use Symfony\Component\HttpFoundation\Response;

class ResolveUserByLink
{
    protected $userLinkRepository;

    public function __construct(UserLinkRepository $userLinkRepository)
    {
        $this->userLinkRepository = $userLinkRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $link = $request->route('link');
        $user = $this->userLinkRepository->getOwner($link);

        if  (!$user) {
            abort(404, 'Link not found or expired');
        }

        $request->attributes->set('user', $user);

        return $next($request);
    }
}
