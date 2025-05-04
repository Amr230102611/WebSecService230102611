<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter as FacadesRateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ThrottleLoginAttempts
{
    /**
     * The rate limiter instance.
     *
     * @var \Illuminate\Cache\RateLimiter
     */
    protected $limiter;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Cache\RateLimiter  $limiter
     * @return void
     */
    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $maxAttempts = 5, int $decayMinutes = 1): Response
    {
        $key = $this->resolveRequestSignature($request);

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            return $this->buildTooManyAttemptsResponse($key, $maxAttempts);
        }

        $response = $next($request);

        // If the login attempt was unsuccessful, increment the counter
        if ($response->getStatusCode() === 302 && !Auth::check() && $request->is('login') && $request->isMethod('post')) {
            $this->limiter->hit($key, $decayMinutes * 60);
        }

        // If the login attempt was successful, clear the counter
        if ($response->getStatusCode() === 302 && Auth::check() && $request->is('login') && $request->isMethod('post')) {
            $this->limiter->clear($key);
        }

        return $response;
    }

    /**
     * Resolve the signature of the request for rate limiting.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function resolveRequestSignature(Request $request): string
    {
        if ($request->has('email')) {
            return 'login|' . $request->ip() . '|' . $request->input('email');
        }
        
        return 'login|' . $request->ip();
    }

    /**
     * Create a response for when the request has been rate limited.
     *
     * @param  string  $key
     * @param  int  $maxAttempts
     * @return \Illuminate\Http\Response
     */
    protected function buildTooManyAttemptsResponse(string $key, int $maxAttempts)
    {
        $seconds = $this->limiter->availableIn($key);
        
        return redirect()->back()->withInput()->withErrors([
            'throttle' => 'Too many login attempts. Please try again in ' . ceil($seconds / 60) . ' minutes.',
        ]);
    }
}
