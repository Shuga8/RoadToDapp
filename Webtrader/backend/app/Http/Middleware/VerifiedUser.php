<?php

namespace App\Http\Middleware;

use App\Traits\HttpResponses;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedUser
{
    use HttpResponses;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = \App\Models\User::where('id', auth()->user()->id)->first();
        if ($user->email_verified_at == null) {
            return $this->error(null, 'Unverifed user', 406);
        } else {
            return $next($request);
        }
    }
}
