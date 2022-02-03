<?php
/**
 * 企業用の機能関連のコントローラー
 *
 * 企業のindexページ、編集、診断、学生、チャット、ログアウト用のコントローラー
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Services\UserService;
use App\Services\ChatService;
use App\Http\Requests\CompanyUpdate;

/**
 * 企業コントローラー用のクラス
 *
 * @package App\Http\Controllers\company
 * @version 1.0
 */
class CompanyController extends Controller
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
     * コンストラクタ
     *
     * @param CompanyService $company
     * @param UserService $user
     * @param ChatService $chat
     * @return void
     */
    public function __construct(CompanyService $company, UserService $user, ChatService $chat)
    {
        $this->company = $company;
        $this->user = $user;
        $this->chat = $chat;
    }

    /**
     * 企業indexページ用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $company = $this->company->getCompanyData(Auth::user()->id);
        if (!isset($company->diagnosis)) {
            return redirect('company/diagnosis');
        }
        return view('company.index',compact('company'));
    }

    /**
     * 企業情報編集画面表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $company = $this->company->getCompanyData(Auth::user()->id);
        return view('company.edit',compact('company'));
    }

    /**
     * 企業情報更新用
     *
     * @param CompanyUpdate $request 企業リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CompanyUpdate $request)
    {
        $this->company->updateCompanyData($request, Auth::user()->id);
        return redirect('/company');
    }

    /**
     * 企業診断画面表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function diagnosis()
    {
        return view('company.diagnosis');
    }

    /**
     * 企業診断追加or更新用
     *
     * @param Request $request リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function diagnosisPost(Request $request)
    {
        $this->company->setCompanyDiagnosisData($request, Auth::user()->id);
        return redirect('/company');
    }

    /**
     * 学生一覧画面表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function student()
    {
        $likeUsers = $this->company->getLikedStudents(Auth::user()->id);
        return view('company.student',compact('likeUsers'));
    }

    /**
     * 学生個別画面表示用
     *
     * @param $id 学生ID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singleStudent($id)
    {
        $user = $this->user->getUserData($id);
        $chatRoomData = $this->chat->existsChatRoom($id, Auth::user()->id);
        $chat = $chatRoomData[0];
        $room_id = $chatRoomData[1];
        return view('company.single',compact('user', 'chat', 'room_id'));
    }

    /**
     * チャットルーム作成
     * 
     * @param Request $request リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createChatRoom(Request $request)
    {
        $room_id = $this->chat->createChatRoom($request->input('student_id'), Auth::user()->id);
        return redirect()->route('company.singleStudent', ['id' => $request->input('student_id')]);
    }

    /**
     * チャット画面表示用
     *
     * @param Request $request リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chat(Request $request)
    {
        $room_id = $this->chat->getChatRoomId($request->input('student_id'), Auth::user()->id);
        $company_user = $this->company->getCompanyData(Auth::user()->id);
        $student_user = $this->user->getUserData($request->input('student_id'));
        $messages = $this->chat->getMessages($room_id);
        $this->chat->setMessageNum($room_id, 0, Auth::user()->id);
        return view('company.chat',compact('room_id','messages','company_user','student_user'));
    }

    /**
     * メッセージ一覧の取得
     *
     * @param $id チャットルームID
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages($id, Request $request)
    {
        $messages = $this->chat->getMessages($id);
        $messagesJsonData = ["messages" => $messages];
        $this->chat->setMessageNum($id, 0, $request->input('company_id'));
        return response()->json($messagesJsonData);
    }

    /**
     * チャットメッセージ送信用
     *
     * @param Request $request リクエスト
     * @return void
     * @todo 送信側の画面も非同期でコメントを更新するようにする
     */
    public function postMessage(Request $request)
    {
        $this->chat->postMessage($request->room_id, 0, Auth::user()->id, $request->message);
        $this->chat->setMessageNum($request->room_id, 0, Auth::user()->id);
    }

    /**;.
     * ログアウト用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/company/login');
    }
}
