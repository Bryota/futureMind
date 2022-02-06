<?php
/**
 * チャット用の機能関連のビジネスロジック
 *
 * 学生データの取得、企業データの取得、のチャットルーム、チャットメッセージの取得・送信のビジネスロジック
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\Services;

use App\DataProvider\RepositoryInterface\ChatRepositoryInterface;
use App\Events\ChatPusher;
use App\Domain\Entity\Chat;

/**
 * チャット用のサービスクラス
 *
 * @package App\Services
 * @version 1.0
 */
class ChatService
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
     * チャットルーム作成
     * 
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return int チャットルームID
     */
    public function createChatRoom(int $student_id, int $company_id): int
    {
        $room_id = $this->chat->createChatRoom($student_id, $company_id);
        return $room_id;
    }

    /**
     * チャットルームの学生データの取得
     *
     * @param int $id チャットルームID
     * @return object 学生データ
     */
    public function getStudentData(int $id): object
    {
        $student_data = $this->chat->getStudentData($id);
        return $student_data;
    }

    /**
     * チャットルームの企業データの取得
     *
     * @param int $room_id チャットルームID
     * @return object 企業データ
     */
    public function getCompanyData(int $room_id): object
    {
        $company_data = $this->chat->getCompanyData($room_id);
        return $company_data;
    }

    /**
     * チャットルームが存在するかどうかの確認
     *
     * @param int $user_id 学生ID
     * @param int $company_id 企業ID
     * @return array チャットルームデータ
     */
    public function existsChatRoom(int $user_id, int $company_id): array
    {
        if ($this->chat->checkChatRoom($user_id, $company_id)) {
            $chat = true;
            $room_id = $this->getChatRoomId($user_id, $company_id);
        } else {
            $chat = false;
            $room_id = 0;
        }
        return [$chat, $room_id];
    }

    /**
     * チャットルームIDの取得
     *
     * @param int $user_id 学生ID
     * @param int $company_id 企業ID
     * @return int チャットルームID
     */
    public function getChatRoomId(int $user_id, int $company_id): int
    {
        $room_id = $this->chat->getChatRoomId($user_id, $company_id);
        return $room_id;
    }

    /**
     * チャットメッセージ一覧の取得
     *
     * @param int $room_id
     * @return object|null メッセージ一覧
     */
    public function getMessages (int $room_id): mixed
    {
        $messages = $this->chat->getMessages($room_id);
        return $messages;
    }

    /**
     * メッセージ投稿
     *
     * @param int $room_id チャットルームID
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @param string $message 投稿メッセージ
     * @return void
     */
    public function postMessage(int $room_id, int $student_id, int $company_id, string $message): void
    {
        $eloquent = $this->chat->postMessage(new Chat($room_id, $student_id, $company_id, $message));
    }

    /**
     * メッセージ数設定
     *
     * @param int $room_id チャットルームID
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return void
     */
    public function setMessageNum(int $room_id, int $student_id, int $company_id): void
    {
        $message_num = $this->chat->getMessageNum($room_id);
        $this->chat->setMessageInfo($room_id, $student_id, $company_id, $message_num);
    }

    /**
     * メッセージ確認有無の設定
     * @param int $room_id チャットルームID
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return void
     */
    public function setCheckedStatus(int $room_id, int $student_id, int $company_id): void
    {
        if ($student_id == 0) {
            $this->chat->setCheckedStatusForUser($room_id);
        } else {
            $this->chat->setCheckedStatusForCompany($room_id);
        }
    }
}
