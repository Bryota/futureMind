<?php
/**
 * 学生ユーザー用の機能関連のコントローラー
 *
 * 学生ユーザーの詳細画面の表示・編集、お気に入り企業機能、チャット機能のコントローラー
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\User\GetYearArray;
use App\Services\User\GetPrefectureArray;
use App\Services\User\GetIndustryArray;
use App\Services\UserService;
use App\Services\ChatService;
use App\Http\Requests\UserUpdate;
use Storage;

/**
 * 学生ユーザーコントロール用のクラス
 *
 * @package App\Http\Controllers\User
 * @version 1.0
 */
class UserController extends Controller
{
    /**
     * @var UserService $user UserServiceインスタンス
     */
    private $user;
    /**
     * @var ChatService $chat ChatServiceインスタンス
     */
    private $chat;

    /**
     * コンストラクタ
     *
     * @param UserService $user ユーザーサービス
     * @param ChatService $chat チャットサービス
     * @return void
     */
    public function __construct(UserService $user, ChatService $chat)
    {
        $this->user = $user;
        $this->chat = $chat;
    }

    /**
     * 学生ユーザー詳細画面表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $userData = $this->user->getUserData(Auth::user()->id);
        return view('user.index',compact('userData'));
    }

    /**
     * 学生ユーザー更新画面表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(){
        $userData = $this->user->getUserData(Auth::user()->id);
        return view('user.edit',compact('userData'));
    }

    /**
     * 学生ユーザー情報更新用
     *
     * @param UserUpdate $request ユーザー更新用リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
     public function update(UserUpdate $request){
        $this->user->updateUserData($request, Auth::user()->id, $request->file('img_name'));
         return redirect('/user');
     }

    /**
     * お気に入り企業表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
     public function likesCompany(){
         $likeCompanies = $this->user->getLikeCompanies(Auth::user()->id);
         return view('user.likes',compact('likeCompanies'));
     }

    /**
     * チャット画面表示用
     *
     * @param $id チャットルームID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
     public function chat($id){
         $room_id = $id;
         $student_user = $this->chat->getStudentData(Auth::user()->id);
         $company_user = $this->chat->getCompanyData($room_id);
         $messages = $this->chat->getMessages($room_id);
         return view('user.chat',compact('room_id','messages','student_user','company_user'));
     }

    /**
     * メッセージ一覧の取得
     *
     * @param $id チャットルームID
     * @return \Illuminate\Http\JsonResponse
     */
     public function getMessages($id){
         $messages = $this->chat->getMessages($id);
         $messagesJsonData = ["messages" => $messages];
         return response()->json($messagesJsonData);
     }

    /**
     * チャットメッセージ送信用
     *
     * @param Request $request リクエスト
     * @param $id チャットルームID
     * @return void
     * @todo 送信側の画面も非同期でコメントを更新するようにする
     */
     public function postMessage(Request $request, $id){
         $this->chat->postMessage($id, Auth::user()->id, 0, $request->message);
         return redirect()->back();
     }
}
