<?php
/**
 * 企業のエンティティ
 *
 * リクエストから受け取った企業データを処理する
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\Domain\Entity;

/**
 * 企業エンティティクラス
 *
 * @package App\Domain\Entity
 * @version 1.0
 */
class Company
{
    /**
     * @var string|null $name 企業名
     */
    private $name;
    /**
     * @var string|null $industry 業界
     */
    private $industry;
    /**
     * @var string|null $office 住所
     */
    private $office;
    /**
     * @var int|null $employee 従業員数
     */
    private $employee;
    /**
     * @var string|null $homepage ホームページ
     */
    private $homepage;
    /**
     * @var string|null $comment コメント
     */
    private $comment;

    /**
     * コンストラクタ
     *
     * @param string|null $name 企業名
     * @param string|null $industry 業界
     * @param string|null $office 住所
     * @param int|null $employee 従業員数
     * @param string|null $homepage ホームページ
     * @param string|null $comment コメント
     * @param string|null $img_name プロフィール画像名
     * @return void
     */
    public function __construct(?string $name, ?string $industry, ?string $office, ?int $employee, ?string $homepage, ?string $comment)
    {
        $this->name = $name;
        $this->industry = $industry;
        $this->office = $office;
        $this->employee = $employee;
        $this->homepage = $homepage;
        $this->comment = $comment;
    }

    /**
     * 企業名の取得
     *
     * @return string 企業名
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 業界の取得
     *
     * @return string 業界
     */
    public function getIndustry(): string
    {
        return $this->industry;
    }

    /**
     * 住所の取得
     *
     * @return string 住所
     */
    public function getOffice(): string
    {
        return $this->office;
    }

    /**
     * 従業員数の取得
     *
     * @return int 従業員数
     */
    public function getEmployee(): int
    {
        return $this->employee;
    }

    /**
     * ホームページの取得
     *
     * @return string ホームページ
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * コメントの取得
     *
     * @return string コメント
     */
    public function getComment(): string
    {
        return $this->comment;
    }
}
