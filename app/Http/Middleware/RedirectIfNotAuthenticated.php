<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach($guards as $guard)
        {
            if(!Auth::guard($guard)->check())
            {
                // Determine the intended redirection route based on the original route
                $routeName = $request->route()->getName();

                $redirectRoute = $this->getRedirectRoute($routeName);

                return redirect($redirectRoute);
            }
        }

        return $next($request);
    }

    //Get the redirection route based on the original route.
    private function getRedirectRoute($routeName)
    {
        // Define the mapping of routes to redirect routes
        $routeMappings = [
            'quote.favorite-quotes' => route('quote.five'),
            'quote.ten' => route('quote.five'),
        ];

        // Return the redirection route based on the original route, or fallback to default route
        return $routeMappings[$routeName] ?? 'login';
    }
}
