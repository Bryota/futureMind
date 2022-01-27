<?php
/**
 * 診断データのミドルウェア
 *
 * リクエストで送られてきた診断データを/3する
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\Http\Middleware;

use Closure;

/**
 * 診断データミドルウェアクラス
 *
 * @package App\Http\Middleware
 * @version 1.0
 */
class DiagnosisDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->developmentvalue = $request->developmentvalue/3;
        $request->socialvalue = $request->socialvalue/3;
        $request->stablevalue = $request->stablevalue/3;
        $request->teammatevalue = $request->teammatevalue/3;
        $request->futurevalue = $request->futurevalue/3;
        return $next($request);
    }
}
