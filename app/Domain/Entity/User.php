<?php
/**
 * 学生のエンティティ
 *
 * リクエストから受け取った学生データを処理する
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\Domain\Entity;

/**
 * 学生エンティティクラス
 *
 * @package App\Domain\Entity
 * @version 1.0
 */
class User
{
    /**
     * @var string|null $name 学生名
     */
    protected $name;
    /**
     * @var string|null $email メールアドレス
     */
    protected $email;
    /**
     * @var string|null $year 卒業年度
     */
    protected $year;
    /**
     * @var string|null $university 大学
     */
    protected $university;
    /**
     * @var string|null $hobby 趣味
     */
    protected $hobby;
    /**
     * @var string|null $club 部活・サークル
     */
    protected $club;
    /**
     * @var string|null $industry 希望業界
     */
    protected $industry;
    /**
     * @var string|null $hometown 出身
     */
    protected $hometown;
    /**
     * @var string|null $img_name プロフィール画像名
     */

    /**
     * コンストラクタ
     *
     * @param string|null $name 学生名
     * @param string|null $email メールアドレス
     * @param string|null $year 卒業年度
     * @param string|null $university 大学
     * @param string|null $hobby 趣味
     * @param string|null $club 部活・サークル
     * @param string|null $industry 希望業界
     * @param string|null $hometown 出身
     * @return void
     */
    public function __construct(?string $name, ?string $email, ?string $year, ?string $university, ?string $hobby, ?string $club, ?string $industry, ?string $hometown)
    {
        $this->name = $name;
        $this->email = $email;
        $this->year = $year;
        $this->university = $university;
        $this->hobby = $hobby;
        $this->club = $club;
        $this->industry = $industry;
        $this->hometown = $hometown;
    }

    /**
     * 学生名の取得
     *
     * @return string 学生名
     */
    public function GetName(): string
    {
        return $this->name;
    }

    /**
     * メールアドレスの取得
     *
     * @return string メールアドレス
     */
    public function GetEmail(): string
    {
        return $this->email;
    }

    /**
     * 卒業年度の取得
     *
     * @return string 卒業年度
     */
    public function GetYear(): string
    {
        return $this->year;
    }

    /**
     * 大学の取得
     *
     * @return string 大学
     */
    public function GetUniversity(): string
    {
        return $this->university;
    }

    /**
     * 趣味の取得
     *
     * @return string 趣味
     */
    public function GetHobby(): string
    {
        return $this->hobby;
    }

    /**
     * 部活・サークルの取得
     *
     * @return string 部活・サークル
     */
    public function GetClub(): string
    {
        return $this->club;
    }

    /**
     * 希望業界の取得
     *
     * @return string 希望業界
     */
    public function GetIndustry(): string
    {
        return $this->industry;
    }

    /**
     * 出身の取得
     *
     * @return string 出身
     */
    public function GetHomeTown(): string
    {
        return $this->hometown;
    }
}
