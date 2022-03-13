<?php

/**
 * 学生自己分析データのエンティティ
 *
 * リクエストから受け取った学生自己分析データを処理する
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */

namespace App\Domain\Entity;

/**
 * 学生自己分析データエンティティクラス
 *
 * @package App\Domain\Entity
 * @version 1.0
 */
class SelfDiagnosisData
{
    /**
     * @var int $developmentvalue 成長意欲データ
     */
    private $developmentvalue;
    /**
     * @var int $socialvalue 社会貢献データ
     */
    private $socialvalue;
    /**
     * @var int $stablevalue 安定データ
     */
    private $stablevalue;
    /**
     * @var int $teammatevalue 仲間データ
     */
    private $teammatevalue;
    /**
     * @var int $fururevalue 将来性データ
     */
    private $fururevalue;
    /**
     * @var int $user_id 学生ID
     */
    private $user_id;

    /**
     * コンストラクタ
     *
     * @param int $developmentvalue 成長意欲データ
     * @param int $socialvalue 社会貢献データ
     * @param int $stablevalue 安定データ
     * @param int $teammatevalue 仲間データ
     * @param int $fururevalue 将来性データ
     * @param int $user_id 学生ID
     * @return void
     */
    public function __construct(int $developmentvalue, int $socialvalue, int $stablevalue, int $teammatevalue, int $fururevalue, int $user_id)
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
     * @return int 成長意欲データ
     */
    public function getDevelopmentValue(): int
    {
        return $this->developmentvalue;
    }

    /**
     * 社会貢献データの取得
     *
     * @return int 社会貢献データ
     */
    public function getSocialValue(): int
    {
        return $this->socialvalue;
    }

    /**
     * 安定データの取得
     *
     * @return int 安定データ
     */
    public function getStableValue(): int
    {
        return $this->stablevalue;
    }

    /**
     * 仲間データの取得
     *
     * @return int 仲間データ
     */
    public function getTeammateValue(): int
    {
        return $this->teammatevalue;
    }

    /**
     * 将来性データの取得
     *
     * @return int 将来性データ
     */
    public function getFutureValue(): int
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
