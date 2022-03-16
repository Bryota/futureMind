<?php

/**
 * チャットのエンティティ
 *
 * リクエストから受け取ったチャットデータを処理する
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */

namespace App\Domain\Entity;

/**
 * チャットエンティティクラス
 *
 * @package App\Domain\Entity
 * @version 1.0
 */
class Chat
{
    /**
     * @var int $room_id チャットルームID
     */
    protected $room_id;
    /**
     * @var int $student_id 学生ID
     */
    protected $student_id;
    /**
     * @var int $company_id 企業ID
     */
    protected $company_id;
    /**
     * @var string $message メッセージ
     */
    protected $message;

    /**
     * コンストラクタ
     *
     * @param int $room_id チャットルームID
     * @param int|null $student_id 学生ID
     * @param int|null $company_id 企業ID
     * @param string $message メッセージ
     * @return void
     */
    public function __construct(int $room_id, mixed $student_id, mixed $company_id, string $message)
    {
        $this->room_id = $room_id;
        $this->student_id = $student_id;
        $this->company_id = $company_id;
        $this->message = $message;
    }

    /**
     * チャットルームIDの取得
     *
     * @return int チャットルームID
     */
    public function getRoomId(): int
    {
        return $this->room_id;
    }

    /**
     * 学生IDの取得
     *
     * @return int|null 学生ID
     */
    public function getStudentId(): mixed
    {
        return $this->student_id;
    }

    /**
     * 企業IDの取得
     *
     * @return int|null 企業ID
     */
    public function getCompanyId(): mixed
    {
        return $this->company_id;
    }

    /**
     * 投稿メッセージの取得
     *
     * @return string メッセージ
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
