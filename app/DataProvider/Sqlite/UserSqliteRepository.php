<?php
/**
 * 学生ユーザー用のデータリポジトリ(SQlite用）
 *
 * DBから学生ユーザーの情報取得・更新、お気に入り企業の取得・確認を担っている
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\DataProvider\Sqlite;

use App\DataProvider\RepositoryInterface\UserRepositoryInterface;
use App\DataProvider\Eloquent\User as EloquentUser;
use App\Domain\Entity\User;
use Illuminate\Support\Facades\DB;


class UserSqliteRepository implements UserRepositoryInterface
{
    /**
     * @var EloquentUser $eloquentUser UserEloquentModel
     */
    private $eloquentUser;
    /**
     * @var \Illuminate\Database\Query\Builder $likesTable likesTable用のクエリビルダ
     */
    private $likesTable;
    /**
     * @var string $connection 接続先DB
     */
    private $connection = 'sqlite';

    /**
     * コンストラクタ
     *
     * @param EloquentUser $eloquentUser UserEloquentModel
     * @return void
     */
    public function __construct(EloquentUser $eloquentUser)
    {
        $this->eloquentUser = $eloquentUser;
        $this->likesTable = DB::table('likes');
    }

    /**
     * 学生データ取得
     *
     * @param int $id 学生ID
     * @return object | null
     */
    public function getUserById(int $id)
    {
        $user = $this->eloquentUser::on($this->connection)->find($id);
        if ($user === null) {
            return null;
        }
        return $user;
    }

    /**
     * 学生データ更新
     *
     * @param User $user 学生データ
     * @param int $id 学生ID
     * @return void
     */
    public function update(User $user, int $id, $file): void
    {
        $eloquent = $this->eloquentUser::on($this->connection)->find($id);
        $eloquent->name = $user->getName();
        $eloquent->email = $user->getEmail();
        $eloquent->year = $user->getYear();
        $eloquent->university = $user->GetUniversity();
        $eloquent->hobby = $user->GetHobby();
        $eloquent->club = $user->GetClub();
        $eloquent->industry = $user->GetIndustry();
        $eloquent->hometown = $user->GetHomeTown();
        if(isset($file)){
            $eloquent->img_name = 'users/' . $file->getClientOriginalName();
        }
        $eloquent->save();
    }

    /**
     * お気に入り企業一覧取得
     *
     * @param int $id 学生ID
     * @return object | null
     */
    public function getLikeCompanies(int $id)
    {
        $likeCompanies = $this->eloquentUser::on($this->connection)->find($id)->likesCompany()->paginate(6);
        if (!isset($likeCompanies)) {
            return null;
        }
        return $likeCompanies;
    }

    /**
     *  お気に入り企業かどうかの確認
     *
     * @param int $user_id 学生ID
     * @param int $company_id 企業ID
     * @return bool
     */
    public function checkIsLiked(int $user_id, int $company_id): bool
    {
        if ($this->likesTable->where('user_id', $user_id)->where('company_id', $company_id)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
