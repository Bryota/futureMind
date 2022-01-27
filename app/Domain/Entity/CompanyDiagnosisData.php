<?php
/**
 * 企業診断データのエンティティ
 *
 * リクエストから受け取った企業診断データを処理する
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\Domain\Entity;

/**
 * 企業診断データエンティティクラス
 *
 * @package App\Domain\Entity
 * @version 1.0
 */
class CompanyDiagnosisData
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
     * @var int $company_id 企業ID
     */
    private $company_id;

    /**
     * コンストラクタ
     *
     * @param string $developmentvalue 成長意欲データ
     * @param string $socialvalue 社会貢献データ
     * @param string $stablevalue 安定データ
     * @param string $teammatevalue 仲間データ
     * @param string $fururevalue 将来性データ
     * @param int $company_id 企業ID
     * @return void
     */
    public function __construct(string $developmentvalue, string $socialvalue, string $stablevalue, string $teammatevalue, string $fururevalue, int $company_id)
    {
        $this->developmentvalue = $developmentvalue;
        $this->socialvalue = $socialvalue;
        $this->stablevalue = $stablevalue;
        $this->teammatevalue = $teammatevalue;
        $this->fururevalue = $fururevalue;
        $this->fururevalue = $fururevalue;
        $this->company_id = $company_id;
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
     * 企業IDの取得
     *
     * @return int 企業ID
     */
    public function getCompanyId(): int
    {
        return $this->company_id;
    }
}
