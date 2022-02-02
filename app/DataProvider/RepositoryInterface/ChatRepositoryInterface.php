<?php
/**
 * チャット用のデータリポジトリインターフェース
 *
 * チャットデータリポジトリ用のインターフェース
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\DataProvider\RepositoryInterface;

use App\DataProvider\Eloquent\Message as EloquentMessage;
use App\Domain\Entity\Chat;

/**
 * チャットデータリポジトリ用のインターフェース
 *
 * @package App\DataProvider\RepositoryInterface
 * @version 1.0
 */
interface ChatRepositoryInterface
{
    /**
     * 学生データの取得
     *
     * @param int $id 学生ID
     * @return object 学生データ
     */
    public function getStudentData(int $id): object;

    /**
     * 企業IDの取得
     *
     * @param int $id チャットルームID
     * @return int 企業ID
     */
    public function getCompanyId(int $id): int;

    /**
     * 企業データの取得
     *
     * @param int $room_id チャットルームID
     * @return object 企業データ
     */
    public function getCompanyData(int $room_id): object;

    /**
     * チャットルーム作成
     * 
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return int チャットルームID
     */
    public function createChatRoom(int $student_id, int $company_id): int;

    /**
     * チャットルームがあるかどうかの確認
     *
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return bool チャットルームがあるかどうか
     */
    public function checkChatRoom(int $student_id, int $company_id): bool;

    /**
     * チャットルームIDの取得
     *
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return int チャットルーID
     */
    public function getChatRoomId(int $student_id, int $company_id): int;

    /**
     * メッセージ一覧の取得
     *
     * @param int $room_id チャットルームID
     * @return object | null メッセージ一覧 | null
     */
    public function getMessages(int $room_id);

    /**
     * メッセージの送信
     *
     * @param Chat $chat チャットルームデータ
     * @return EloquentMessage MessageEloquentModel
     */
    public function postMessage(Chat $chat): EloquentMessage;

    /**
     * メッセージ数取得
     *
     * @param int $room_id チャットルームID
     * @return int メッセージ数
     */
    public function getMessageNum(int $room_id): int;

    /**
     * メッセージ数設定
     *
     * @param int $room_id チャットルームID
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @param int $message_num メッセージ数
     * @return void
     */
    public function setMessageNum(int $room_id, int $student_id, int $company_id, int $message_num): void;

    /**
     * 確認済みメッセージ数取得
     *
     * @param int $room_id チャットルームID
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return int 確認済みメッセージ数
     */
    public function getCheckedMessageNum(int $room_id, int $student_id, int $company_id): int;
}
