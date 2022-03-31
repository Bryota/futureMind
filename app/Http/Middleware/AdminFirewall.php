<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\IpUtils;

class AdminFirewall
{
    /**
     * @var string $allowe_ip 許可するIPアドレス
     */
    private $allowe_ip;

    public function __construct()
    {
        $this->allowe_ip = config('app.allowed_ip');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('app.env') === 'local' || $this->isAllowedIp($request->ip())) {
            return $next($request);
        }

        throw new AuthorizationException(sprintf('Access denied from %s', $request->ip()));
    }

    /**
     * IPアドレスをチェック
     * 
     * @param string $ip
     * @return bool
     */
    private function isAllowedIp(string $ip): bool
    {
        return IpUtils::checkIp($ip, ['127.0.0.1', $this->allowe_ip]);
    }
}
