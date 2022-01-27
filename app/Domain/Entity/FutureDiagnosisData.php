<?php
/**
 * 学生理想分析データのエンティティ
 *
 * リクエストから受け取った学生理想分析データを処理する
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\Domain\Entity;

/**
 * 学生理想分析データエンティティクラス
 *
 * @package App\Domain\Entity
 * @version 1.0
 */
class FutureDiagnosisData
{
    /**
     * @var string $developmentvalue 成長意欲データ
     */
    private $developmentvalue;
    /**
     * @var string $socialvalue 社会貢献データ
     */
    private $socialvalue;
    /**
     * @var string $stablevalue 安定データ
     */
    private $stablevalue;
    /**
     * @var string $teammatevalue 仲間データ
     */
    private $teammatevalue;
    /**
     * @var string $fururevalue 将来性データ
     */
    private $fururevalue;
    /**
     * @var int $user_id 学生ID
     */
    private $user_id;

    /**
     * コンストラクタ
     *
     * @param string $developmentvalue 成長意欲データ
     * @param string $socialvalue 社会貢献データ
     * @param string $stablevalue 安定データ
     * @param string $teammatevalue 仲間データ
     * @param string $fururevalue 将来性データ
     * @param int $user_id 学生ID
     * @return void
     */
    public function __construct(string $developmentvalue, string $socialvalue, string $stablevalue, string $teammatevalue, string $fururevalue, int $user_id)
    {
        $this->developmentvalue = $developmentvalue;
        $this->socialvalue = $socialvalue;
        $this->stablevalue = $stablevalue;
        $this->teammatevalue = $teammatevalue;
        $this->fururevalue = $fururevalue;
        $this->fururevalue = $fururevalue;
        $this->user_id = $user_id;
    }

    /**
     * 成長意欲データの取得
     *
     * @return string 成長意欲データ
     */
    public function getDevelopmentValue(): string
    {
        return $this->developmentvalue;
    }

    /**
     * 社会貢献データの取得
     *
     * @return string 社会貢献データ
     */
    public function getSocialValue(): string
    {
        return $this->socialvalue;
    }

    /**
     * 安定データの取得
     *
     * @return string 安定データ
     */
    public function getStableValue(): string
    {
        return $this->stablevalue;
    }

    /**
     * 仲間データの取得
     *
     * @return string 仲間データ
     */
    public function getTeammateValue(): string
    {
        return $this->teammatevalue;
    }

    /**
     * 将来性データの取得
     *
     * @return string 将来性データ
     */
    public function getFutureValue(): string
    {
        return $this->fururevalue;
    }

    /**
     * 学生IDの取得
     *
     * @return int 学生ID
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }
}
