<?php

/**
 * 企業用の機能関連のビジネスロジック
 *
 * 企業の情報取得・更新、検索企業の取得、企業診断の追加、お気に入りされた学生の取得のビジネスロジック
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */

namespace App\Services;

use App\DataProvider\RepositoryInterface\CompanyRepositoryInterface;
use App\DataProvider\RepositoryInterface\ChatRepositoryInterface;
use App\Domain\Entity\Company;
use App\Domain\Entity\CompanyDiagnosisData;
use App\DataProvider\Storage\S3\S3Interface\S3Interface;
use Illuminate\Http\Request;

/**
 * 企業用のサービスクラス
 *
 * @package App\Services
 * @version 1.0
 */
class CompanyService
{
    /**
     * @var CompanyRepositoryInterface $company CompanyRepositoryInterfaceインスタンス
     */
    private $company;

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
     * @param CompanyRepositoryInterface $company 企業リポジトリインターフェース
     * @return void
     */
    public function __construct(CompanyRepositoryInterface $company, ChatRepositoryInterface $chat, S3Interface $storage)
    {
        $this->company = $company;
        $this->chat = $chat;
        $this->storage = $storage;
    }

    /**
     * 企業データの取得
     *
     * @param int $id 企業ID
     * @return object 企業データ
     */
    public function getCompanyData(int $id): object
    {
        $companyData = $this->company->getCompanyDataById($id);
        if (isset($companyData->company_icon)) {
            $companyData['profilePath'] = $this->storage->getProfilePath($companyData->company_icon);
        } else {
            $companyData['profilePath'] = null;
        }
        return $companyData;
    }

    /**
     * 検索企業一覧データの取得
     *
     * @param string $employee 従業員数データ
     * @param string $industry 業界データ
     * @param string $area 住所データ
     * @param int $developmentValue 成長意欲データ
     * @param int $socialValue 社会貢献データ
     * @param int $stableValue 安定データ
     * @param int $teammateValue 仲間データ
     * @param int $futureValue 将来性データ
     * @return object 検索後の企業一覧データ
     */
    public function getSearchedCompanies(string $employee, string $industry, string $area, int $developmentValue, int $socialValue, int $stableValue, int $teammateValue, int $futureValue): object
    {
        if ($employee === '~50') {
            $employee = [0, 50];
        }
        if ($employee === '51~100') {
            $employee = [51, 100];
        }
        if ($employee === '101~300') {
            $employee = [101, 300];
        }
        if ($employee === '301~500') {
            $employee = [301, 500];
        }
        if ($employee === '501~1000') {
            $employee = [501, 1000];
        }
        if ($employee === '1000~') {
            $employee = [1001, 1000000000];
        }
        $companies = $this->company->getSearchedCompanies($employee, $industry, $area, $developmentValue, $socialValue, $stableValue, $teammateValue, $futureValue);
        return $companies;
    }

    /**
     * 企業データの更新
     *
     * @param Request $request リクエスト
     * @param int $company_id 企業ID
     * @return void
     */
    public function updateCompanyData(Request $request, int $company_id, $file): void
    {
        $company = new Company(
            $request->name,
            $request->industry,
            $request->office,
            $request->employee,
            $request->homepage,
            $request->comment
        );
        if (isset($file)) {
            $this->storage->putFileToCompany($file);
        }
        $this->company->updateCompanydata($company, $company_id, $file);
    }

    /**
     * 企業診断データの追加or更新
     *
     * @param Request $request リクエスト
     * @param int $company_id 企業ID
     * @return void
     */
    public function setCompanyDiagnosisData(Request $request, int $company_id): void
    {
        $companyDiagnosisData = new CompanyDiagnosisData(
            $request->developmentvalue,
            $request->socialvalue,
            $request->stablevalue,
            $request->teammatevalue,
            $request->futurevalue,
            $company_id
        );
        $this->company->setCompanyDiagnosisData($companyDiagnosisData, $company_id);
    }

    /**
     * お気に入りされた学生一覧の取得
     *
     * @param int $company_id 企業ID
     * @return object お気に入りされた学生一覧
     */
    public function getLikedStudents(int $company_id): object
    {
        $students = $this->company->getLikedStudents($company_id);
        foreach ($students as $student) {
            if ($this->chat->checkChatRoom($student->id, $company_id)) {
                $room_id = $this->chat->getChatRoomId($student->id, $company_id);
                $messageNum = $this->chat->getMessageNum($room_id);
                $checkedMessageNum = $this->chat->getCheckedMessageNum($room_id, 0, $company_id);
                if (is_null($checkedMessageNum)) {
                    $checkedMessageNum = 0;
                }
                $unCheckedMessageNum = $messageNum - $checkedMessageNum;
                $student->unCheckedMessageNum = $unCheckedMessageNum;
            }
        }
        return $students;
    }
}
