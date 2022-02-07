<?php
/**
 * チャット用のデータリポジトリ
 *
 * DBから学生データ・企業データの取得、チャットルームの確認、取得、メッセージの取得・追加を担っている
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\DataProvider;

use App\DataProvider\RepositoryInterface\ChatRepositoryInterface;
use App\DataProvider\Eloquent\ChatRoom as EloquentChatRoom;
use App\DataProvider\Eloquent\User as EloquentUser;
use App\DataProvider\Eloquent\Company as EloquentCompany;
use App\DataProvider\Eloquent\Message as EloquentMessage;
use App\DataProvider\Eloquent\MessageInfo as EloquentMessageInfo;
use App\Domain\Entity\Chat;

/**
 * チャットリポジトリクラス
 *
 * @package App\DataProvider
 * @version 1.0
 */
class ChatRepository implements ChatRepositoryInterface
{
    /**
     * @var EloquentChatRoom $eloquentChatRoom ChatRoomEloquentModel
     */
    private $eloquentChatRoom;
    /**
     * @var EloquentUser $eloquentUser UserEloquentModel
     */
    private $eloquentUser;
    /**
     * @var EloquentCompany $eloquentCompany CompanyEloquentModel
     */
    private $eloquentCompany;
    /**
     * @var EloquentMessage MessageEloquentModel
     */
    private $eloquentMessage;
    /**
     * @var EloquentMessageInfo MessageInfoEloquentModel
     */
    private $eloquentMessageInfo;

    /**
     * コンストラクタ
     *
     * @param EloquentChatRoom $chatRoom ChatRoomEloquentModel
     * @param EloquentUser $user UserEloquentModel
     * @param EloquentCompany $company CompanyEloquentModel
     * @param EloquentMessage $message MessageEloquentModel
     * @return void
     */
    public function __construct(EloquentChatRoom $chatRoom, EloquentUser $user, EloquentCompany $company, EloquentMessage $message, EloquentMessageInfo $messageInfo)
    {
        $this->eloquentChatRoom = $chatRoom;
        $this->eloquentUser = $user;
        $this->eloquentCompany = $company;
        $this->eloquentMessage = $message;
        $this->eloquentMessageInfo = $messageInfo;
    }

    /**
     * 学生データの取得
     *
     * @param int $id 学生ID
     * @return object 学生データ
     */
    // TODO: 定義の場所がおかしい
    public function getStudentData(int $id): object
    {
        $studentData = $this->eloquentUser::where('id', $id)->first();
        return $studentData;
    }

    /**
     * 学生IDの取得
     *
     * @param int $room_id チャットルームID
     * @return int 学生ID
     */
    public function getStudentId(int $room_id): int
    {
        $student_ids = $this->eloquentChatRoom::where('id', $room_id)->pluck('user_id');
        $student_id = $student_ids[0];
        return $student_id;
    }

    /**
     * 企業IDの取得
     *
     * @param int $id チャットルームID
     * @return int 企業ID
     */
    public function getCompanyId(int $id): int
    {
        $company_ids = $this->eloquentChatRoom::where('id', $id)->pluck('company_id');
        $company_id = $company_ids[0];
        return $company_id;
    }

    /**
     *  企業データの取得
     *
     * @param int $room_id チャットルームID
     * @return object 企業データ
     */
    public function getCompanyData(int $room_id): object
    {
        $company_id = $this->getCompanyId($room_id);
        $companyData = $this->eloquentCompany::where('id', $company_id)->first();
        return $companyData;
    }

    /**
     * チャットルーム作成
     * 
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return int チャットルームID
     */
    public function createChatRoom(int $student_id, int $company_id): int
    {
        $chat_room_data = $this->eloquentChatRoom::create([
            'user_id' => $student_id,
            'company_id' => $company_id
        ]);
        return $chat_room_data->id;
    }

    /**
     * チャットルームがあるかどうかの確認
     *
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return bool チャットルームがあるかどうか
     */
    public function checkChatRoom(int $student_id, int $company_id): bool
    {
        if ($this->eloquentChatRoom::where('user_id', $student_id)->where('company_id', $company_id)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * チャットルームIDの取得
     *
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return int チャットルームID
     */
    public function getChatRoomId(int $student_id, int $company_id): int
    {
        $room_ids = $this->eloquentChatRoom::where('user_id', $student_id)
                                            ->where('company_id', $company_id)
                                            ->get(['id'])
                                            ->pluck('id');
        $room_id = $room_ids[0];
        return $room_id;
    }

    /**
     * メッセージ一覧の取得
     *
     * @param int $room_id チャットルームID
     * @return object | null メッセージ一覧 | null
     */
    public function getMessages(int $room_id)
    {
        if ($this->eloquentMessage::where('room_id',$room_id)->exists()) {
            $messages = $this->eloquentMessage::where('room_id',$room_id)->get(['message','student_user','company_user']);
        } else {
            $messages = null;
        }
        return $messages;
    }

    /**
     * メッセージの送信
     *
     * @param Chat $chat チャットルームデータ
     * @return EloquentMessage MessageEloquentModel
     */
    public function postMessage(Chat $chat): EloquentMessage
    {
        $eloquent = $this->eloquentMessage->newInstance();
        $eloquent->room_id = $chat->getRoomId();
        $eloquent->student_user = $chat->getStudentId();
        $eloquent->company_user = $chat->getCompanyId();
        $eloquent->message = $chat->getMessage();
        $eloquent->save();
        return $eloquent;
    }

    /**
     * メッセージ数取得
     *
     * @param int $room_id チャットルームID
     * @return int メッセージ数
     */
    public function getMessageNum(int $room_id): int
    {
        $message_num = $this->eloquentMessage::where('room_id', $room_id)->count();
        return $message_num;
    }

    /**
     * メッセージ情報設定
     *
     * @param int $room_id チャットルームID
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @param int $message_num メッセージ数
     * @return void
     */
    public function setMessageInfo(int $room_id, int $student_id, int $company_id, int $message_num): void
    {
        $this->eloquentMessageInfo::updateOrCreate(
            [
                "room_id" => $room_id,
                "student_user" => $student_id,
                "company_user" => $company_id,
            ],
            [
                "room_id" => $room_id,
                "student_user" => $student_id,
                "company_user" => $company_id,
                "message_num" => $message_num,
                "checked_status" => true
            ]
        );
    }

    /**
     * 確認済みメッセージ数取得
     *
     * @param int $room_id チャットルームID
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return int|null 確認済みメッセージ数
     */
    public function getCheckedMessageNum(int $room_id, int $student_id, int $company_id): mixed
    {
        $message_num_data = $this->eloquentMessageInfo::where([
                                            ['room_id', $room_id],
                                            ['student_user', $student_id],
                                            ['company_user', $company_id]
                                        ])
                                        ->first();
        if (is_null($message_num_data)) {
            return 0;
        } else {
            return $message_num_data->message_num;
        }
    }

    /**
     * メッセージ確認有無の設定（学生用）
     * @param int $room_id チャットルームID
     */
    public function setCheckedStatusForUser(int $room_id, int $student_id): void
    {
        $this->eloquentMessageInfo::updateOrCreate(
                            [
                                'room_id' => $room_id,
                                'company_user' => 0
                            ],
                            [
                                "room_id" => $room_id,
                                "student_user" => $student_id,
                                "company_user" => 0,
                                'checked_status' => false
                            ]
                        );
    }

    /**
     * メッセージ確認有無の設定（企業用）
     * @param int $room_id チャットルームID
     */
    public function setCheckedStatusForCompany(int $room_id, int $company_id): void
    {
        $this->eloquentMessageInfo::updateOrCreate(
                            [
                                'room_id' => $room_id,
                                'student_user' => 0
                            ],
                            [
                                "room_id" => $room_id,
                                "student_user" => 0,
                                "company_user" => $company_id,
                                'checked_status' => false
                            ]
                        );
    }

    /**
     * 未確認メッセージ取得（学生用）
     * @param int $student_id 学生ID
     */
    public function getUncheckedMessageForUser(int $student_id): int
    {
        return $this->eloquentMessageInfo::where([
                                ['student_user', $student_id],
                                ['checked_status', false]
                            ])
                            ->count();
    }

    /**
     * 未確認メッセージ取得（企業用）
     * @param int $company_id 企業ID
     */
    public function getUncheckedMessageForCompany(int $company_id): int
    {
        return $this->eloquentMessageInfo::where([
                                ['company_user', $company_id],
                                ['checked_status', false]
                            ])
                            ->count();
    }
}
