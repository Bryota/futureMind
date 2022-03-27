<?php

/**
 * 学生ユーザー用の機能関連のビジネスロジック
 *
 * 学生ユーザーの情報取得、情報更新、お気に入り機能のビジネスロジック
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */

namespace App\Services;

use App\DataProvider\RepositoryInterface\UserRepositoryInterface;
use App\DataProvider\RepositoryInterface\ChatRepositoryInterface;
use App\DataProvider\Storage\S3\S3Interface\S3Interface;
use App\Domain\Entity\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Storage;

/**
 * 学生ユーザー用のサービスクラス
 *
 * @package App\Services
 * @version 1.0
 */
class UserService
{
    /**
     * @var UserRepositoryInterface $user UserRepositoryInterfaceインスタンス
     */
    private $user;

    /**
     * @var ChatRepositoryInterface $chat ChatRepositoryInterfaceインスタンス
     */
    private $chat;

    /**
     * @var S3Interface $storage S3Interfaceインスタンス
     */
    private $storage;

    /**
     * コンストラクタ
     *
     * @param UserRepositoryInterface $user ユーザーリポジトリインターフェース
     */
    public function __construct(UserRepositoryInterface $user, ChatRepositoryInterface $chat, S3Interface $storage)
    {
        $this->user = $user;
        $this->chat = $chat;
        $this->storage = $storage;
    }

    /**
     * 学生詳細データの取得
     *
     * @param int $id 学生ID
     * @return object 学生詳細データ
     */
    public function getUserData(int $id): object
    {
        $userData = $this->user->getUserById($id);
        if (isset($userData->img_name)) {
            $userData['profilePath'] = $this->storage->getProfilePath($userData->img_name);
        } else {
            $userData['profilePath'] = null;
        }
        return $userData;
    }

    /**
     * 学生詳細データの更新
     *
     * @param Request $request リクエスト
     * @param int $userId 学生ID
     * @param UploadedFile $file 画像データ
     * @return void
     */
    public function updateUserData(Request $request, int $userId, ?UploadedFile $file): void
    {
        $user = new User(
            $request->name,
            $request->email,
            $request->year,
            $request->university,
            $request->hobby,
            $request->club,
            $request->industry,
            $request->hometown
        );
        if (isset($file)) {
            $this->storage->putFileToUsers($file);
        }
        $this->user->update($user, $userId, $file);
    }

    /**
     * お気に入り企業一覧データの取得
     *
     * @param int $id 学生ID
     * @return object お気に入り企業一覧データ
     */
    public function getLikeCompanies(int $id): object
    {
        $likeCompanies = $this->user->getLikeCompanies($id);
        foreach ($likeCompanies as $company) {
            if ($this->chat->checkChatRoom($id, $company->id)) {
                $room_id = $this->chat->getChatRoomId($id, $company->id);
                $messageNum = $this->chat->getMessageNum($room_id);
                $checkedMessageNum = $this->chat->getCheckedMessageNum($room_id, $id, null);
                if (is_null($checkedMessageNum)) {
                    $checkedMessageNum = 0;
                }
                $unCheckedMessageNum = $messageNum - $checkedMessageNum;
                $company->unCheckedMessageNum = $unCheckedMessageNum;
            }
        }
        return $likeCompanies;
    }

    /**
     * お気に入り企業かどうかの確認
     *
     * @param int $user_id 学生ID
     * @param int $company_id 企業ID
     * @return bool お気に入り企業かどうか
     */
    public function isLiked(int $user_id, int $company_id): bool
    {
        $isLiked = $this->user->checkIsLiked($user_id, $company_id);
        return $isLiked;
    }

    /**
     * 全学生数取得
     * 
     * @return int 全学生数
     */
    public function getStudentNum(): int
    {
        return $this->user->getStudentNum();
    }
}
