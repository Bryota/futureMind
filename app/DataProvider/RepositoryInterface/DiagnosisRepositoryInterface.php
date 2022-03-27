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
use Illuminate\Http\Request;

/**
 * 診断データリポジトリ用のインターフェース
 *
 * @package App\DataProvider\RepositoryInterface
 * @version 1.0
 */
interface DiagnosisRepositoryInterface
{
    /**
     * 診断質問一覧の取得
     * 
     * @return object 診断質問一覧
     */
    public function getAllDiagnosisQuestions(): object;

    /**
     * 診断質問の1つ取得
     * 
     * @param int $id 診断質問ID
     * @return object 診断質問一覧
     */
    public function getDiagnosisQuestionByID(int $id): object;

    /**
     * 診断質問更新
     * 
     * @param Requestu $requset 診断結果リクエスト
     * @param int $id 診断質問ID
     * @return void
     */
    public function updateDiagnosisQuestion(Request $request, int $id): void;

    /**
     * 診断質問削除
     * 
     * @param int $id 診断質問ID
     * @return void
     */
    public function deleteDiagnosisQuestion(int $id): void;

    /**
     * 理想分析データの追加or更新
     *
     * @param int $student_id 学生ID
     * @param FutureDiagnosisData $futureDiagnosisData 理想分析データ
     * @return void
     */
    public function setFutureDiagnosisForStudent(int $student_id, FutureDiagnosisData $futureDiagnosisData): void;

    /**
     * 自己分析データの追加or更新
     *
     * @param int $student_id 学生ID
     * @param SelfDiagnosisData $selfDiagnosisData 自己分析データ
     * @return void
     */
    public function setSelfDiagnosisForStudent(int $student_id, SelfDiagnosisData $selfDiagnosisData): void;

    /**
     * 理想分析があるかどうかの確認
     *
     * @param int $user_id 学生ID
     * @return int
     */
    public function checkFutureDiagnosisDataExist(int $user_id): int;

    /**
     * 自己分析があるかどうかの確認
     *
     * @param int $user_id 学生ID
     * @return int
     */
    public function checkSelfDiagnosisDataExist(int $user_id): int;

    /**
     * 理想分析データの取得
     *
     * @param int $user_id 学生ID
     * @return object | null 理想分析データ
     */
    public function getFutureDiagnosisData(int $user_id): mixed;

    /**
     * 自己分析データの取得
     *
     * @param int $user_id 学生ID
     * @return object | null 自己分析データ
     */
    public function getSelfDiagnosisData(int $user_id): mixed;

    /**
     * 理想分析コメントの取得
     *
     * @param string $futureCommentType 理想分析コメントタイプ
     * @return object 理想分析用のコメント
     */
    public function getFutureDiagnosisComment(string $futureCommentType): object;

    /**
     * 自己分析コメントの取得
     *
     * @param string $selfCommentType 自己分析コメントタイプ
     * @return object 自己分析用のコメント
     */
    public function getSelfDiagnosisComment(string $selfCommentType): object;

    /**
     * なりたい自分へコメントの取得
     *
     * @param string $toFutureCommentType なりたい自分へコメントタイプ
     * @return object なりたい自分へ用のコメント
     */
    public function getToFutureComment(string $toFutureCommentType): object;

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
    public function addLikedCompany(int $student_id, int $company_id): void;

    /**
     * 理想診断全てのコメント取得
     * 
     * @return object
     */
    public function getAllFutureDiagnosisComments(): object;

    /**
     * 理想診断1つのコメント取得
     * 
     * @param int $id コメントID
     * @return object
     */
    public function getFutureDiagnosisCommentByID(int $id): object;

    /**
     * 理想診断コメント更新
     * 
     * @param Request $request コメントリクエスト
     * @param int $id コメントID
     * @return void
     */
    public function updateFutureComment(Request $request, int $id): void;

    /**
     * 理想診断コメント削除
     * 
     * @param int $id コメントID
     * @return void
     */
    public function deleteFutureComment(int $id): void;

    /**
     * 自己診断全てのコメント取得
     * 
     * @return object
     */
    public function getAllSelfDiagnosisComments(): object;

    /**
     * 自己診断1つのコメント取得
     * 
     * @param int $id コメントID
     * @return object
     */
    public function getSelfDiagnosisCommentByID(int $id): object;

    /**
     * 自己診断コメント更新
     * 
     * @param Request $request コメントリクエスト
     * @param int $id コメントID
     * @return void
     */
    public function updateSelfComment(Request $request, int $id): void;

    /**
     * 自己診断コメント削除
     * 
     * @param int $id コメントID
     * @return void
     */
    public function deleteSelfComment(int $id): void;

    /**
     * 診断結果全てのコメント取得
     * 
     * @return object
     */
    public function getAllDiagnosisComments(): object;

    /**
     * 診断結果1つのコメント取得
     * 
     * @param int $id コメントID
     * @return object
     */
    public function getDiagnosisCommentByID(int $id): object;

    /**
     * 診断結果コメント更新
     * 
     * @param Request $request コメントリクエスト
     * @param int $id コメントID
     * @return void
     */
    public function updateDiagnosisComment(Request $request, int $id): void;

    /**
     * 診断結果コメント削除
     * 
     * @param int $id コメントID
     * @return void
     */
    public function deleteDiagnosisComment(int $id): void;

    /**
     * 理想分析会社全てのコメント取得
     * 
     * @return object
     */
    public function getAllFutureCompanyComments(): object;

    /**
     * 理想分析会社1つのコメント取得
     * 
     * @param int $id コメントID
     * @return object
     */
    public function getFutureCompanyCommentByID(int $id): object;

    /**
     * 理想分析会社コメント更新
     * 
     * @param Request $request コメントリクエスト
     * @param int $id コメントID
     * @return void
     */
    public function updateFutureCompanyComment(Request $request, int $id): void;

    /**
     * 理想分析会社コメント削除
     * 
     * @param int $id コメントID
     * @return void
     */
    public function deleteFutureCompanyComment(int $id): void;

    /**
     * 自己分析会社全てのコメント取得
     * 
     * @return object
     */
    public function getAllSelfCompanyComments(): object;

    /**
     * 自己分析会社1つのコメント取得
     * 
     * @param int $id コメントID
     * @return object
     */
    public function getSelfCompanyCommentByID(int $id): object;

    /**
     * 自己分析会社コメント更新
     * 
     * @param Request $request コメントリクエスト
     * @param int $id コメントID
     * @return void
     */
    public function updateSelfCompanyComment(Request $request, int $id): void;

    /**
     * 自己分析会社コメント削除
     * 
     * @param int $id コメントID
     * @return void
     */
    public function deleteSelfCompanyComment(int $id): void;
}
