<?php
/**
 * 企業検索用の機能関連のコントローラー
 *
 * 企業検索の検索画面、検索結果、企業個別ページのコントローラー
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Builder;
use App\Services\CompanyService;
use App\Services\UserService;
use App\Services\ChatService;
use App\Services\DiagnosisServices;

/**
 * 企業検索コントローラー用のクラス
 *
 * @package App\Http\Controllers\User
 * @version 1.0
 */
class SearchCompanyController extends Controller
{
    /**
     * @var CompanyService $company CompanyServiceインスタンス
     */
    private $company;
    /**
     * @var UserService $user UserServiceインスタンス
     */
    private $user;
    /**
     * @var ChatService $chat ChatServiceインスタンス
     */
    private $chat;
    /**
     * @var DiagnosisServices $diagnosis DiagnosisServicesインスタンス
     */
    private $diagnosis;

    /**
     * コンストラクタ
     *
     * @param CompanyService $company 企業サービス
     * @param UserService $user ユーザーサービス
     * @param ChatService $chat チャットサービス
     * @param DiagnosisServices $diagnosis 診断サービス
     * @return void
     */
    public function __construct(CompanyService $company, UserService $user, ChatService $chat, DiagnosisServices $diagnosis)
    {
        $this->company = $company;
        $this->user = $user;
        $this->chat = $chat;
        $this->diagnosis = $diagnosis;
    }

    /**
     * 企業検索画面表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        return view('companySearch.search');
    }

    /**
     * 企業検索&企業検索結果画面表示用
     *
     * @param Request $request リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchPost(Request $request)
    {
        $companies = $this->company->getSearchedCompanies(
            $request->employee,
            $request->industry,
            $request->area,
            $request->development,
            $request->social,
            $request->stable,
            $request->teammate,
            $request->future
        );
        return view('companySearch.result',compact('companies'));
    }

    /**
     * 企業個別画面表示用
     *
     * @param $id 企業ID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($id)
    {
        $company = $this->company->getCompanyData($id);
        $isLiked = $this->user->isLiked(Auth::user()->id, $id);
        $chatRoomData = $this->chat->existsChatRoom(Auth::user()->id, $id);
        $chat = $chatRoomData[0];
        $room_id = $chatRoomData[1];
        $company_id = $id;
        return view('companySearch.single',compact('company','isLiked','chat','room_id','company_id'));
    }

    /**
     * お気に入り企業追加用
     *
     * @param Request $request リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function likeCompany(Request $request)
    {
        // TODO: isliked判定のみの実装にして、企業個別ページにリダイレクトさせる
        $company = $this->company->getCompanyData($request->id);
        $this->diagnosis->addLikedCompany(Auth::user()->id, $request->id);
        $isLiked = $this->diagnosis->checkIsLiked(Auth::user()->id, $request->id);
        $chat = false;
        return view('companySearch.single',compact('company','isLiked','chat'));
    }
}
