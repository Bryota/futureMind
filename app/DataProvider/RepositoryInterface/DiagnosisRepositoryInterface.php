<?php
/**
 * 診断用のデータリポジトリインターフェース
 *
 * 診断データリポジトリ用のインターフェース
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\DataProvider\RepositoryInterface;

use App\Domain\Entity\FutureDiagnosisData;
use App\Domain\Entity\SelfDiagnosisData;

/**
 * 診断データリポジトリ用のインターフェース
 *
 * @package App\DataProvider\RepositoryInterface
 * @version 1.0
 */
interface DiagnosisRepositoryInterface
{
    /**
     * 理想分析データの追加or更新
     *
     * @param $student_id 学生ID
     * @param FutureDiagnosisData $futureDiagnosisData 理想分析データ
     * @return void
     */
    public function setFutureDiagnosisForStudent($student_id, FutureDiagnosisData $futureDiagnosisData): void;

    /**
     * 自己分析データの追加or更新
     *
     * @param $student_id 学生ID
     * @param SelfDiagnosisData $selfDiagnosisData 自己分析データ
     * @return void
     */
    public function setSelfDiagnosisForStudent($student_id, SelfDiagnosisData $selfDiagnosisData): void;

    /**
     * 理想分析があるかどうかの確認
     *
     * @param $user_id 学生ID
     * @return int
     */
    public function checkFutureDiagnosisDataExist($user_id): int;

    /**
     * 自己分析があるかどうかの確認
     *
     * @param $user_id 学生ID
     * @return int
     */
    public function checkSelfDiagnosisDataExist($user_id): int;

    /**
     * 理想分析データの取得
     *
     * @param $user_id 学生ID
     * @return object | null 理想分析データ
     */
    public function getFutureDiagnosisData($user_id): mixed;

    /**
     * 自己分析データの取得
     *
     * @param $user_id 学生ID
     * @return object | null 自己分析データ
     */
    public function getSelfDiagnosisData($user_id): mixed;

    /**
     * 理想分析コメントの取得
     *
     * @param $futureCommentType 理想分析コメントタイプ
     * @return object 理想分析用のコメント
     */
    public function getFutureDiagnosisComment($futureCommentType): object;

    /**
     * 自己分析コメントの取得
     *
     * @param $selfCommentType 自己分析コメントタイプ
     * @return object 自己分析用のコメント
     */
    public function getSelfDiagnosisComment($selfCommentType): object;

    /**
     * なりたい自分へコメントの取得
     *
     * @param $toFutureCommentType なりたい自分へコメントタイプ
     * @return object なりたい自分へ用のコメント
     */
    public function getToFutureComment($toFutureCommentType): object;

    /**
     * 診断に紐づいた企業一覧の取得
     *
     * @param int $developmentValue 成長意欲データ
     * @param int $socialValue 社会貢献データ
     * @param int $stableValue 安定データ
     * @param int $teammateValue 仲間データ
     * @param int $futureValue 将来性データ
     * @return object 企業一覧データ
     */
    public function getCompaniesFromDiagnosisData(int $developmentValue, int $socialValue, int $stableValue, int $teammateValue, int $futureValue): object;

    /**
     * 企業診断データの取得
     *
     * @param int $company_id 企業ID
     * @return object 企業診断データ
     */
    public function getCompanyDiagnosisData(int $company_id): object;

    /**
     * 自己分析に紐づいた企業コメントの取得
     *
     * @param string $forCompanyCommentType 企業コメントタイプ
     * @return object 自己分析に紐づいた企業コメント
     */
    public function getFutureCompanyCommentComparedWithSelfDiagnosisData(string $forCompanyCommentType): object;

    /**
     * 理想分析に紐づいた企業コメントの取得
     *
     * @param string $forCompanyCommentType 企業コメントタイプ
     * @return object 理想分析に紐づいた企業コメント
     */
    public function getSelfCompanyCommentComparedWithFutureDiagnosisData(string $forCompanyCommentType): object;

    /**
     * お気に入り企業かどうかの確認
     *
     * @param int $user_id 学生ID
     * @param int $company_id 企業ID
     * @return bool お気に入り企業かどうか
     */
    public function checkIsLiked(int $user_id, int $company_id): bool;

    /**
     * お気に入り企業の追加
     *
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return void
     */
    public function addLikedCompany(int $student_id, int $company_id):void;
}
