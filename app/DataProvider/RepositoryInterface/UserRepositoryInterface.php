<?php
/**
 * 学生用のデータリポジトリインターフェース
 *
 * 学生データリポジトリ用のインターフェース
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\DataProvider\RepositoryInterface;

use App\Domain\Entity\User;
use phpDocumentor\Reflection\File;

/**
 * 学生データリポジトリ用のインターフェース
 *
 * @package App\DataProvider\RepositoryInterface
 * @version 1.0
 */
interface UserRepositoryInterface
{
    /**
     * 学生データ取得
     *
     * @param int $id 学生ID
     * @return object | null
     */
    public function getUserById(int $id);

    /**
     * 学生データ更新
     *
     * @param User $user 学生データ
     * @param int $id 学生ID
     * @param $file プロフィール画像
     * @return void
     */
    public function update(User $user, int $id, $file): void;

    /**
     * お気に入り企業一覧取得
     *
     * @param int $id 学生ID
     * @return object | null
     */
    public function getLikeCompanies(int $id);

    /**
     *  お気に入り企業かどうかの確認
     *
     * @param int $user_id 学生ID
     * @param int $company_id 企業ID
     * @return bool
     */
    public function checkIsLiked(int $user_id, int $company_id): bool;
}