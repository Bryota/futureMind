<?php

/**
 * 企業用のデータリポジトリインターフェース
 *
 * 企業データリポジトリ用のインターフェース
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */

namespace App\DataProvider\RepositoryInterface;

use App\Domain\Entity\Company;
use App\Domain\Entity\CompanyDiagnosisData;
use Illuminate\Http\UploadedFile;

/**
 * 企業データリポジトリ用のインターフェース
 *
 * @package App\DataProvider\RepositoryInterface
 * @version 1.0
 */
interface CompanyRepositoryInterface
{
    /**
     * 企業データの取得
     *
     * @param int $id 企業ID
     * @return object 企業データ
     */
    public function getCompanyDataById(int $id): object;

    /**
     * 検索企業一覧データの取得
     *
     * @param array $employee 従業員数データ
     * @param string $industry 業界データ
     * @param string $area 住所データ
     * @param int $developmentValue 成長意欲データ
     * @param int $socialValue 社会貢献データ
     * @param int $stableValue 安定データ
     * @param int $teammateValue 仲間データ
     * @param int $futureValue 将来性データ
     * @return object 検索企業一覧データ
     */
    public function getSearchedCompanies(array $employee, string $industry, string $area, int $developmentValue, int $socialValue, int $stableValue, int $teammateValue, int $futureValue): object;

    /**
     * 企業データの更新
     *
     * @param Company $company 企業データ
     * @param int $company_id 企業ID
     * @param UploadedFile $file 画像データ
     * @param string $voice 音声データ
     * @return void
     */
    public function updateCompanyData(Company $company, int $company_id, ?UploadedFile $file, ?string $voice): void;

    /**
     * 企業診断データの追加or更新
     *
     * @param CompanyDiagnosisData $companyDiagnosisData 企業診断データ
     * @param int $company_id 企業ID
     * @return void
     */
    public function setCompanyDiagnosisData(CompanyDiagnosisData $companyDiagnosisData, int $company_id): void;

    /**
     * お気に入りされた学生一覧データの取得
     *
     * @param int $company_id 企業ID
     * @return object お気に入りされた学生一覧データ
     */
    public function getLikedStudents(int $company_id): object;

    /**
     * 全企業数取得
     * 
     * @return int 全企業数
     */
    public function getCompanyNum(): int;
}
