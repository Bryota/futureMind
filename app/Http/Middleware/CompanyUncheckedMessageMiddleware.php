<?php

namespace App\Http\Middleware;

use App\DataProvider\RepositoryInterface\ChatRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyUncheckedMessageMiddleware
{
    /**
     * @var ChatRepositoryInterface $chat ChatRepositoryInterfaceインスタンス
     */
    private $chat;

    /**
     * コンストラクタ
     *
     * @param ChatRepositoryInterface $chat チャットリポジトリインターフェース
     * @return void
     */
    public function __construct(ChatRepositoryInterface $chat)
    {
        $this->chat = $chat;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->chat->getUncheckedMessageForCompany(Auth::user()->id)) {
            session(['is_uncheckedMessage_for_company' => true]);
        } else {
            session(['is_uncheckedMessage_for_company' => false]);
        }
        return $next($request);
    }
}
