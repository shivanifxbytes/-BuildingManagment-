<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfNotAdmin
{
/**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @param  string|null  $guard
 * @return mixed
 */
public function handle($request, Closure $next, $guard = 'admin')
{
    if (isset(auth()->user()->user_role_id))
    {
    	if(!auth()->user()->user_role_id == 1) {
    	return redirect('/');
    	}
    }
    else
    {
    	return redirect('/');
    }   
    return $next($request);
    }
}  