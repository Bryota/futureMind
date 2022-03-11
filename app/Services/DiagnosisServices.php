<?php

/**
 * 学生診断用の機能関連のビジネスロジック
 *
 * 学生診断の診断情報追加・取得、診断結果のコメント取得、関連企業の取得、お気に入り企業の追加のビジネスロジック
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */

namespace App\Services;

use App\DataProvider\RepositoryInterface\DiagnosisRepositoryInterface;
use App\Domain\Entity\FutureDiagnosisData;
use App\Domain\Entity\SelfDiagnosisData;
use App\models\FutureSingleCompanyComment;

/**
 * 学生診断用のサービスクラス
 *
 *
 * @package App\Services
 * @version 1.0
 */
class DiagnosisServices
{
    /**
     * @var DiagnosisRepositoryInterface $diagnosis DiagnosisRepositoryInterfaceインスタンス
     */
    private $diagnosis;

    /**
     * コンストラクタ
     *
     * @param DiagnosisRepositoryInterface $diagnosis 診断リポジトリインターフェース
     * @return void
     */
    public function __construct(DiagnosisRepositoryInterface $diagnosis)
    {
        $this->diagnosis = $diagnosis;
    }

    /**
     * 理想分析のデータ追加or更新
     *
     * @param $student_id 学生ID
     * @param $developmentValue 成長意欲データ
     * @param $socialValue 社会貢献データ
     * @param $stableValue 安定データ
     * @param $teammateValue 仲間データ
     * @param $futureValue 将来性データ
     * @return void
     */
    public function setFutureDiagnosisForStudent($student_id, $developmentValue, $socialValue, $stableValue, $teammateValue, $futureValue): void
    {
        $this->diagnosis->setFutureDiagnosisForStudent($student_id, new FutureDiagnosisData(
            $developmentValue,
            $socialValue,
            $stableValue,
            $teammateValue,
            $futureValue,
            $student_id
        ));
    }

    /**
     * 自己分析のデータ追加or更新
     *
     * @param $student_id 学生ID
     * @param $developmentValue 成長意欲データ
     * @param $socialValue 社会貢献データ
     * @param $stableValue 安定データ
     * @param $teammateValue 仲間データ
     * @param $futureValue 将来性データ
     * @return void
     */
    public function setSelfDiagnosisForStudent($student_id, $developmentValue, $socialValue, $stableValue, $teammateValue, $futureValue): void
    {
        $this->diagnosis->setSelfDiagnosisForStudent($student_id, new SelfDiagnosisData(
            $developmentValue,
            $socialValue,
            $stableValue,
            $teammateValue,
            $futureValue,
            $student_id
        ));
    }

    /**
     * 理想分析があるかどうかの確認
     *
     * @param $user_id 学生ID
     * @return
     */
    public function checkFutureDiagnosisDataExist($user_id)
    {
        return $this->diagnosis->checkFutureDiagnosisDataExist($user_id);
    }

    /**
     * 自己分析があるかどうかの確認
     *
     * @param $user_id 学生ID
     * @return
     */
    public function checkSelfDiagnosisDataExist($user_id)
    {
        return $this->diagnosis->checkSelfDiagnosisDataExist($user_id);
    }

    /**
     * 理想分析データの取得
     *
     * @param $user_id 学生ID
     * @return array 理想分析データ
     */
    public function getFutureDiagnosisData($user_id): array
    {
        // HACK: 配列にする必要があるのか考える
        $futureDiagnosisData = $this->diagnosis->getFutureDiagnosisData($user_id);
        $futureDiagnosisDataAsArray = array();
        $futureDiagnosisDataAsArray[] = $futureDiagnosisData->developmentvalue;
        $futureDiagnosisDataAsArray[] = $futureDiagnosisData->socialvalue;
        $futureDiagnosisDataAsArray[] = $futureDiagnosisData->stablevalue;
        $futureDiagnosisDataAsArray[] = $futureDiagnosisData->teammatevalue;
        $futureDiagnosisDataAsArray[] = $futureDiagnosisData->futurevalue;
        return $futureDiagnosisDataAsArray;
    }

    /**
     * 自己分析データの取得
     *
     * @param $user_id 学生ID
     * @return array
     */
    public function getSelfDiagnosisData($user_id): array
    {
        // HACK: 配列にする必要があるのか考える
        $selfDiagnosisData = $this->diagnosis->getSelfDiagnosisData($user_id);
        $selfDiagnosisDataAsArray = array();
        $selfDiagnosisDataAsArray[] = $selfDiagnosisData->developmentvalue;
        $selfDiagnosisDataAsArray[] = $selfDiagnosisData->socialvalue;
        $selfDiagnosisDataAsArray[] = $selfDiagnosisData->stablevalue;
        $selfDiagnosisDataAsArray[] = $selfDiagnosisData->teammatevalue;
        $selfDiagnosisDataAsArray[] = $selfDiagnosisData->futurevalue;
        return $selfDiagnosisDataAsArray;
    }

    /**
     * 理想分析コメントの取得
     *
     * @param array $futureDiagnosisDataAsArray 理想分析データ
     * @return array 理想分析のコメント
     */
    public function getFutureDiagnosisComments(array $futureDiagnosisDataAsArray): array
    {
        $futureMaxes = array_keys($futureDiagnosisDataAsArray, max($futureDiagnosisDataAsArray));
        $futureCommentTypes = [];
        for ($i = 0; $i < count($futureMaxes); $i++) {
            $futureCommentType = '';
            if ($futureMaxes[$i] === 0) {
                $futureCommentType = '成長意欲';
            }
            if ($futureMaxes[$i] === 1) {
                $futureCommentType = '社会貢献';
            }
            if ($futureMaxes[$i] === 2) {
                $futureCommentType = '安定';
            }
            if ($futureMaxes[$i] === 3) {
                $futureCommentType = '仲間';
            }
            if ($futureMaxes[$i] === 4) {
                $futureCommentType = '将来性';
            }
            array_push($futureCommentTypes, $futureCommentType);
        }
        $futureComments = [];
        for ($i = 0; $i < count($futureCommentTypes); $i++) {
            $futureComment = $this->diagnosis->getFutureDiagnosisComment($futureCommentTypes[$i]);
            array_push($futureComments, $futureComment);
        }
        return $futureComments;
    }

    /**
     * 自己分析コメントの取得
     *
     * @param array $selfDiagnosisDataAsArray 自己分析データ
     * @return array 自己分析のコメント
     */
    public function getSelfDiagnosisComments(array $selfDiagnosisDataAsArray): array
    {
        $selfMaxes   = array_keys($selfDiagnosisDataAsArray, max($selfDiagnosisDataAsArray));
        $selfCommentTypes = [];
        for ($i = 0; $i < count($selfMaxes); $i++) {
            $selfCommentType = '';
            if ($selfMaxes[$i] === 0) {
                $selfCommentType = '成長意欲';
            }
            if ($selfMaxes[$i] === 1) {
                $selfCommentType = '社会貢献';
            }
            if ($selfMaxes[$i] === 2) {
                $selfCommentType = '安定';
            }
            if ($selfMaxes[$i] === 3) {
                $selfCommentType = '仲間';
            }
            if ($selfMaxes[$i] === 4) {
                $selfCommentType = '将来性';
            }
            array_push($selfCommentTypes, $selfCommentType);
        }
        $selfComments = [];
        for ($i = 0; $i < count($selfCommentTypes); $i++) {
            $selfComment = $this->diagnosis->getSelfDiagnosisComment($selfCommentTypes[$i]);
            array_push($selfComments, $selfComment);
        }
        return $selfComments;
    }

    /**
     * なりたい自分へのコメント取得
     *
     * @param array $futureDiagnosisDataAsArray 理想分析データ
     * @param array $selfDiagnosisDataAsArray 自己分析データ
     * @return array なりたい自分へのコメント
     */
    public function getToFutureComments(array $futureDiagnosisDataAsArray, array $selfDiagnosisDataAsArray): array
    {
        $comparedFutureAndSelfData = array();
        for ($i = 0; $i < count($futureDiagnosisDataAsArray); $i++) {
            $comparedFutureAndSelfData[$i] = $futureDiagnosisDataAsArray[$i] - $selfDiagnosisDataAsArray[$i];
        }
        $toFutureMaxes   = array_keys($comparedFutureAndSelfData, max($comparedFutureAndSelfData));
        $toFutureCommentTypes = [];
        for ($i = 0; $i < count($toFutureMaxes); $i++) {
            $toFutureCommentType = '';
            if ($toFutureMaxes[$i] === 0) {
                $toFutureCommentType = '成長意欲';
            }
            if ($toFutureMaxes[$i] === 1) {
                $toFutureCommentType = '社会貢献';
            }
            if ($toFutureMaxes[$i] === 2) {
                $toFutureCommentType = '安定';
            }
            if ($toFutureMaxes[$i] === 3) {
                $toFutureCommentType = '仲間';
            }
            if ($toFutureMaxes[$i] === 4) {
                $toFutureCommentType = '将来性';
            }
            array_push($toFutureCommentTypes, $toFutureCommentType);
        }
        $toFutureComments = [];
        for ($i = 0; $i < count($toFutureCommentTypes); $i++) {
            $toFutureComment = $this->diagnosis->getToFutureComment($toFutureCommentTypes[$i]);
            array_push($toFutureComments, $toFutureComment);
        }
        return $toFutureComments;
    }

    /**
     * 理想分析に関連した企業一覧の取得
     *
     * @param $user_id 学生ID
     * @return object 理想分析に関連した企業一覧
     */
    public function getCompaniesRelatedToFutureDiagnosisData($user_id): object
    {
        $futureDiagnosisData = $this->getFutureDiagnosisData($user_id);
        $developmentValue = $futureDiagnosisData[0];
        $socialValue = $futureDiagnosisData[1];
        $stableValue = $futureDiagnosisData[2];
        $teammateValue = $futureDiagnosisData[3];
        $futureValue = $futureDiagnosisData[4];
        $companies = $this->diagnosis->getCompaniesFromDiagnosisData($developmentValue, $socialValue, $stableValue, $teammateValue, $futureValue);
        return $companies;
    }

    /**
     * 自己分析に関連した企業一覧の取得
     *
     * @param $user_id 学生ID
     * @return object 自己分析に関連した企業一覧
     */
    public function getCompaniesRelatedToSelfDiagnosisData($user_id): object
    {
        $selfDiagnosisData = $this->getSelfDiagnosisData($user_id);
        $developmentValue = $selfDiagnosisData[0];
        $socialValue = $selfDiagnosisData[1];
        $stableValue = $selfDiagnosisData[2];
        $teammateValue = $selfDiagnosisData[3];
        $futureValue = $selfDiagnosisData[4];
        $companies = $this->diagnosis->getCompaniesFromDiagnosisData($developmentValue, $socialValue, $stableValue, $teammateValue, $futureValue);
        return $companies;
    }

    /**
     * 理想分析に関連した企業のコメントの所得
     *
     * @param $company_id 企業ID
     * @param $student_id 学生ID
     * @return array 理想分析に関連した企業用のコメント
     */
    public function getCompanyCommentForFuture($company_id, $student_id): array
    {
        $companyData = $this->diagnosis->getCompanyDiagnosisData($company_id);
        $selfData = $this->diagnosis->getSelfDiagnosisData($student_id);
        $forCompanyData = array();
        $forCompanyData[] = $companyData->developmentvalue;
        $forCompanyData[] = $companyData->socialvalue;
        $forCompanyData[] = $companyData->stablevalue;
        $forCompanyData[] = $companyData->teammatevalue;
        $forCompanyData[] = $companyData->futurevalue;
        $forSelfData = array();
        $forSelfData[] = $selfData->developmentvalue;
        $forSelfData[] = $selfData->socialvalue;
        $forSelfData[] = $selfData->stablevalue;
        $forSelfData[] = $selfData->teammatevalue;
        $forSelfData[] = $selfData->futurevalue;
        $forCompanyValue = array();
        for ($i = 0; $i < count($forCompanyData); $i++) {
            $forCompanyValue[$i] = $forCompanyData[$i] - $forSelfData[$i];
        }
        $forCompanyMaxes = array_keys($forCompanyValue, max($forCompanyValue));
        $forCompanyCommentTypes = [];
        for ($i = 0; $i < count($forCompanyMaxes); $i++) {
            $commentType = '';
            if (max($forCompanyValue) <= 0) {
                $commentType = 'なし';
                array_push($forCompanyCommentTypes, $commentType);
                break;
            }
            if ($forCompanyMaxes[$i] === 0) {
                $commentType = '成長意欲';
            }
            if ($forCompanyMaxes[$i] === 1) {
                $commentType = '社会貢献';
            }
            if ($forCompanyMaxes[$i] === 2) {
                $commentType = '安定';
            }
            if ($forCompanyMaxes[$i] === 3) {
                $commentType = '仲間';
            }
            if ($forCompanyMaxes[$i] === 4) {
                $commentType = '将来性';
            }
            array_push($forCompanyCommentTypes, $commentType);
        }
        $forCompanyComments = [];
        for ($i = 0; $i < count($forCompanyCommentTypes); $i++) {
            $forCompanyComment = $this->diagnosis->getFutureCompanyCommentComparedWithSelfDiagnosisData($forCompanyCommentTypes[$i]);
            array_push($forCompanyComments, $forCompanyComment);
        }
        return $forCompanyComments;
    }

    /**
     * 自己分析に関連した企業のコメントの所得
     *
     * @param $company_id 企業ID
     * @param $student_id 学生ID
     * @return array 自己分析に関連した企業用のコメント
     */
    public function getCompanyCommentForSelf($company_id, $student_id): array
    {
        $companyData = $this->diagnosis->getCompanyDiagnosisData($company_id);
        $futureData = $this->diagnosis->getFutureDiagnosisData($student_id);
        $forCompanyData = array();
        $forCompanyData[] = $companyData->developmentvalue;
        $forCompanyData[] = $companyData->socialvalue;
        $forCompanyData[] = $companyData->stablevalue;
        $forCompanyData[] = $companyData->teammatevalue;
        $forCompanyData[] = $companyData->futurevalue;
        $forFutureData = array();
        $forFutureData[] = $futureData->developmentvalue;
        $forFutureData[] = $futureData->socialvalue;
        $forFutureData[] = $futureData->stablevalue;
        $forFutureData[] = $futureData->teammatevalue;
        $forFutureData[] = $futureData->futurevalue;
        $forCompanyValue = array();
        for ($i = 0; $i < count($forCompanyData); $i++) {
            $forCompanyValue[$i] = $forFutureData[$i] - $forCompanyData[$i];
        }
        $forCompanyMaxes = array_keys($forCompanyValue, max($forCompanyValue));
        $forCompanyCommentTypes = [];
        for ($i = 0; $i < count($forCompanyMaxes); $i++) {
            $commentType = '';
            if (max($forCompanyValue) <= 0) {
                $commentType = 'なし';
                array_push($forCompanyCommentTypes, $commentType);
                break;
            }
            if ($forCompanyMaxes[$i] === 0) {
                $commentType = '成長意欲';
            }
            if ($forCompanyMaxes[$i] === 1) {
                $commentType = '社会貢献';
            }
            if ($forCompanyMaxes[$i] === 2) {
                $commentType = '安定';
            }
            if ($forCompanyMaxes[$i] === 3) {
                $commentType = '仲間';
            }
            if ($forCompanyMaxes[$i] === 4) {
                $commentType = '将来性';
            }
            array_push($forCompanyCommentTypes, $commentType);
        }
        $forCompanyComments = [];
        for ($i = 0; $i < count($forCompanyCommentTypes); $i++) {
            $forCompanyComment = $this->diagnosis->getFutureCompanyCommentComparedWithSelfDiagnosisData($forCompanyCommentTypes[$i]);
            array_push($forCompanyComments, $forCompanyComment);
        }
        return $forCompanyComments;
    }

    /**
     * お気に入り企業かどうかの確認
     *
     * @param int $user_id 学生ID
     * @param int $company_id 企業ID
     * @return bool お気に入り企業かどうか
     */
    public function checkIsLiked(int $user_id, int $company_id): bool
    {
        $isLiked = $this->diagnosis->checkIsLiked($user_id, $company_id);
        return $isLiked;
    }

    /**
     * お気に入り企業の追加
     *
     * @param $student_id 学生ID
     * @param $company_id 企業ID
     * @return void
     */
    public function addLikedCompany($student_id, $company_id): void
    {
        $this->diagnosis->addLikedCompany($student_id, $company_id);
    }
}
