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
use App\DataProvider\RepositoryInterface\DiagnosisRepositoryInterface;

/**
 * 診断データミドルウェアクラス
 *
 * @package App\Http\Middleware
 * @version 1.0
 */
class DiagnosisDataMiddleware
{
    /**
     * @var DiagnosisRepositoryInterface $diagnosis DiagnosisRepositoryInterfaceインスタンス
     */
    private $diagnosis;

    /**
     * コンストラクタ
     * 
     * @param DiagnosisRepositoryInterface $diagnosis 診断リポジトリインターフェース
     */
    public function __construct(DiagnosisRepositoryInterface $diagnosis)
    {
        $this->diagnosis = $diagnosis;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $development_sum = $this->diagnosis->getDiagnosisQuestionsByDiagnosisType(0) * 5;
        $social_sum = $this->diagnosis->getDiagnosisQuestionsByDiagnosisType(1) * 5;
        $stable_sum = $this->diagnosis->getDiagnosisQuestionsByDiagnosisType(2) * 5;
        $teammate_sum = $this->diagnosis->getDiagnosisQuestionsByDiagnosisType(3) * 5;
        $future_sum = $this->diagnosis->getDiagnosisQuestionsByDiagnosisType(4) * 5;

        $request->developmentvalue = round(($request->developmentvalue * 5) / $development_sum);
        $request->socialvalue = round(($request->socialvalue * 5) / $social_sum);
        $request->stablevalue = round(($request->stablevalue * 5) / $stable_sum);
        $request->teammatevalue = round(($request->teammatevalue * 5) / $teammate_sum);
        $request->futurevalue = round(($request->futurevalue * 5) / $future_sum);

        return $next($request);
    }
}
