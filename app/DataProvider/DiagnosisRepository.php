<?php

/**
 * 学生診断用のデータリポジトリ
 *
 * DBから学生診断の理想分析・自己分析の追加・更新・取得、コメント取得、関連企業の取得を担っている
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */

namespace App\DataProvider;

use App\DataProvider\RepositoryInterface\DiagnosisRepositoryInterface;
use App\DataProvider\Eloquent\FutureDiagnosisData as EloquentFutureDiagnosis;
use App\DataProvider\Eloquent\SelfDiagnosisData as EloquentSelfDiagnosis;
use App\DataProvider\Eloquent\FutureDiagnosisComment as EloquentFutureDiagnosisComment;
use App\DataProvider\Eloquent\SelfDiagnosisComment as EloquentSelfDiagnosisComment;
use App\DataProvider\Eloquent\ToFutureComment as EloquentToFutureComment;
use App\DataProvider\Eloquent\Company as EloquentCompany;
use App\DataProvider\Eloquent\CompanyDiagnosisData as EloquentCompanyDiagnosisData;
use App\DataProvider\Eloquent\FutureSingleCompanyComment as EloquentFutureSingleCompanyComment;
use App\DataProvider\Eloquent\SelfSingleCompanyComment as EloquentSelfSingleCompanyComment;
use App\Domain\Entity\FutureDiagnosisData;
use App\Domain\Entity\SelfDiagnosisData;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Mixed_;

/**
 * 診断リポジトリクラス
 *
 * @package App\DataProvider
 * @version 1.0
 */
class DiagnosisRepository implements DiagnosisRepositoryInterface
{
    /**
     * @var EloquentFutureDiagnosis $eloquentFutureDiagnosis FutureDiagnosisEloquentModel
     */
    private $eloquentFutureDiagnosis;
    /**
     * @var EloquentSelfDiagnosis $eloquentSelfDiagnosis SelfDiagnosisEloquentModel
     */
    private $eloquentSelfDiagnosis;
    /**
     * @var EloquentFutureDiagnosisComment $eloquentFutureDiagnosisComment FutureDiagnosisCommentEloquentModel
     */
    private $eloquentFutureDiagnosisComment;
    /**
     * @var EloquentSelfDiagnosisComment $eloquentSelfDiagnosisComment SelfDiagnosisCommentCommentEloquentModel
     */
    private $eloquentSelfDiagnosisComment;
    /**
     * @var EloquentToFutureComment $eloquentToFutureComment ToFutureCommentCommentEloquentModel
     */
    private $eloquentToFutureComment;
    /**
     * @var EloquentCompany $eloquentCompany CompanyEloquentModel
     */
    private $eloquentCompany;
    /**
     * @var EloquentCompanyDiagnosisData $eloquentCompanyDiagnosisData CompanyDiagnosisDataEloquentModel
     */
    private $eloquentCompanyDiagnosisData;
    /**
     * @var EloquentFutureSingleCompanyComment $eloquentFutureSingleCompanyComment FutureSingleCompanyCommentEloquentModel
     */
    private $eloquentFutureSingleCompanyComment;
    /**
     * @var EloquentSelfSingleCompanyComment $eloquentSelfSingleCompanyComment SelfSingleCompanyCommentEloquentModel
     */
    private $eloquentSelfSingleCompanyComment;

    /**
     * コンストラクタ
     *
     * @param EloquentFutureDiagnosis $futureDiagnosis FutureDiagnosisEloquentModel
     * @param EloquentSelfDiagnosis $selfDiagnosis SelfDiagnosisEloquentModel
     * @param EloquentFutureDiagnosisComment $futureDiagnosisComment FutureDiagnosisCommentEloquentModel
     * @param EloquentSelfDiagnosisComment $selfDiagnosisComment SelfDiagnosisCommentCommentEloquentModel
     * @param EloquentToFutureComment $toFutureComment ToFutureCommentCommentEloquentModel
     * @param EloquentCompany $company CompanyEloquentModel
     * @param EloquentCompanyDiagnosisData $companyDiagnosisData CompanyDiagnosisDataEloquentModel
     * @param EloquentFutureSingleCompanyComment $futureSingleCompanyComment FutureSingleCompanyCommentEloquentModel
     * @param EloquentSelfSingleCompanyComment $selfSingleCompanyComment SelfSingleCompanyCommentEloquentModel
     * @return void
     */
    public function __construct(
        EloquentFutureDiagnosis $futureDiagnosis,
        EloquentSelfDiagnosis $selfDiagnosis,
        EloquentFutureDiagnosisComment $futureDiagnosisComment,
        EloquentSelfDiagnosisComment $selfDiagnosisComment,
        EloquentToFutureComment $toFutureComment,
        EloquentCompany $company,
        EloquentCompanyDiagnosisData $companyDiagnosisData,
        EloquentFutureSingleCompanyComment $futureSingleCompanyComment,
        EloquentSelfSingleCompanyComment $selfSingleCompanyComment
    ) {
        $this->eloquentFutureDiagnosis = $futureDiagnosis;
        $this->eloquentSelfDiagnosis = $selfDiagnosis;
        $this->eloquentFutureDiagnosisComment = $futureDiagnosisComment;
        $this->eloquentSelfDiagnosisComment = $selfDiagnosisComment;
        $this->eloquentToFutureComment = $toFutureComment;
        $this->eloquentCompany = $company;
        $this->eloquentCompanyDiagnosisData = $companyDiagnosisData;
        $this->eloquentFutureSingleCompanyComment = $futureSingleCompanyComment;
        $this->eloquentSelfSingleCompanyComment = $selfSingleCompanyComment;
    }

    /**
     * 理想分析データの追加or更新
     *
     * @param int $student_id 学生ID
     * @param FutureDiagnosisData $futureDiagnosisData 理想分析データ
     * @return void
     */
    public function setFutureDiagnosisForStudent(int $student_id, FutureDiagnosisData $futureDiagnosisData): void
    {
        if ($this->eloquentFutureDiagnosis::where('user_id', $student_id)->first() === null) {
            $eloquent = $this->eloquentFutureDiagnosis->newInstance();
            $eloquent->developmentvalue = (int)$futureDiagnosisData->getDevelopmentValue();
            $eloquent->socialvalue = (int)$futureDiagnosisData->getSocialValue();
            $eloquent->stablevalue = (int)$futureDiagnosisData->getStableValue();
            $eloquent->teammatevalue = (int)$futureDiagnosisData->getTeammateValue();
            $eloquent->futurevalue = (int)$futureDiagnosisData->getFutureValue();
            $eloquent->user_id = (int)$futureDiagnosisData->getUserId();
            $eloquent->save();
        } else {
            $eloquent = $this->eloquentFutureDiagnosis::where('user_id', $student_id)->first();
            $eloquent->developmentvalue = (int)$futureDiagnosisData->getDevelopmentValue();
            $eloquent->socialvalue = (int)$futureDiagnosisData->getSocialValue();
            $eloquent->stablevalue = (int)$futureDiagnosisData->getStableValue();
            $eloquent->teammatevalue = (int)$futureDiagnosisData->getTeammateValue();
            $eloquent->futurevalue = (int)$futureDiagnosisData->getFutureValue();
            $eloquent->save();
        }
    }

    /**
     * 自己分析データの追加or更新
     *
     * @param int $student_id 学生ID
     * @param SelfDiagnosisData $selfDiagnosisData 自己分析データ
     * @return void
     */
    public function setSelfDiagnosisForStudent(int $student_id, SelfDiagnosisData $selfDiagnosisData): void
    {
        if ($this->eloquentSelfDiagnosis::where('user_id', $student_id)->first() === null) {
            $eloquent = $this->eloquentSelfDiagnosis->newInstance();
            $eloquent->developmentvalue = (int)$selfDiagnosisData->getDevelopmentValue();
            $eloquent->socialvalue = (int)$selfDiagnosisData->getSocialValue();
            $eloquent->stablevalue = (int)$selfDiagnosisData->getStableValue();
            $eloquent->teammatevalue = (int)$selfDiagnosisData->getTeammateValue();
            $eloquent->futurevalue = (int)$selfDiagnosisData->getFutureValue();
            $eloquent->user_id = (int)$selfDiagnosisData->getUserId();
            $eloquent->save();
        } else {
            $eloquent = $this->eloquentSelfDiagnosis::where('user_id', $student_id)->first();
            $eloquent->developmentvalue = (int)$selfDiagnosisData->getDevelopmentValue();
            $eloquent->socialvalue = (int)$selfDiagnosisData->getSocialValue();
            $eloquent->stablevalue = (int)$selfDiagnosisData->getStableValue();
            $eloquent->teammatevalue = (int)$selfDiagnosisData->getTeammateValue();
            $eloquent->futurevalue = (int)$selfDiagnosisData->getFutureValue();
            $eloquent->save();
        }
    }

    /**
     * 理想分析があるかどうかの確認
     *
     * @param int $user_id 学生ID
     * @return int
     */
    public function checkFutureDiagnosisDataExist(int $user_id): int
    {
        $futureDiagnosisDataCount = $this->eloquentFutureDiagnosis::where('user_id', $user_id)->count();
        return $futureDiagnosisDataCount;
    }

    /**
     * 自己分析があるかどうかの確認
     *
     * @param int $user_id 学生ID
     * @return int
     */
    public function checkSelfDiagnosisDataExist(int $user_id): int
    {
        $selfDiagnosisDataCount = $this->eloquentSelfDiagnosis::where('user_id', $user_id)->count();
        return $selfDiagnosisDataCount;
    }

    /**
     * 理想分析データの取得
     *
     * @param int $user_id 学生ID
     * @return object | null 理想分析データ
     */
    public function getFutureDiagnosisData(int $user_id): mixed
    {
        $futureDiagnosisData = $this->eloquentFutureDiagnosis::where('user_id', $user_id)->first();
        return $futureDiagnosisData;
    }

    /**
     * 自己分析データの取得
     *
     * @param int $user_id 学生ID
     * @return object | null 自己分析データ
     */
    public function getSelfDiagnosisData(int $user_id): mixed
    {
        $selfDiagnosisData = $this->eloquentSelfDiagnosis::where('user_id', $user_id)->first();
        return $selfDiagnosisData;
    }

    /**
     * 理想分析コメントの取得
     *
     * @param string $futureCommentType 理想分析コメントタイプ
     * @return object 理想分析用のコメント
     */
    public function getFutureDiagnosisComment(string $futureCommentType): object
    {
        $futureComment = $this->eloquentFutureDiagnosisComment::where('comment_type', $futureCommentType)->first();
        return $futureComment;
    }

    /**
     * 自己分析コメントの取得
     *
     * @param string $selfCommentType 自己分析コメントタイプ
     * @return object 自己分析用のコメント
     */
    public function getSelfDiagnosisComment(string $selfCommentType): object
    {
        $selfComment = $this->eloquentSelfDiagnosisComment::where('comment_type', $selfCommentType)->first();
        return $selfComment;
    }

    /**
     * なりたい自分へコメントの取得
     *
     * @param string $toFutureCommentType なりたい自分へコメントタイプ
     * @return object なりたい自分へ用のコメント
     */
    public function getToFutureComment(string $toFutureCommentType): object
    {
        $toFutureComment = $this->eloquentToFutureComment::where('comment_type', $toFutureCommentType)->first();
        return $toFutureComment;
    }

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
    public function getCompaniesFromDiagnosisData(int $developmentValue, int $socialValue, int $stableValue, int $teammateValue, int $futureValue): object
    {
        $companies = $this->eloquentCompany::whereHas('diagnosis', function ($query) use ($developmentValue, $socialValue, $stableValue, $teammateValue, $futureValue) {
            $query->where('developmentvalue', $developmentValue);
            $query->Where('socialvalue', $socialValue);
            $query->Where('stablevalue', $stableValue);
            $query->orWhere('teammatevalue', $teammateValue);
            $query->orWhere('futurevalue', $futureValue);
        })
            ->paginate(6);
        return $companies;
    }

    /**
     * 企業診断データの取得
     *
     * @param int $company_id 企業ID
     * @return object 企業診断データ
     */
    public function getCompanyDiagnosisData(int $company_id): object
    {
        $companyDiagnosisData = $this->eloquentCompanyDiagnosisData::where('company_id', $company_id)->first();
        return $companyDiagnosisData;
    }

    /**
     * 自己分析に紐づいた企業コメントの取得
     *
     * @param string $forCompanyCommentType 企業コメントタイプ
     * @return object 自己分析に紐づいた企業コメント
     */
    public function getFutureCompanyCommentComparedWithSelfDiagnosisData(string $forCompanyCommentType): object
    {
        $forCompanyComment = $this->eloquentFutureSingleCompanyComment::where('comment_type', $forCompanyCommentType)->first();
        return $forCompanyComment;
    }

    /**
     * 理想分析に紐づいた企業コメントの取得
     *
     * @param string $forCompanyCommentType 企業コメントタイプ
     * @return object 理想分析に紐づいた企業コメント
     */
    public function getSelfCompanyCommentComparedWithFutureDiagnosisData(string $forCompanyCommentType): object
    {
        $forCompanyComment = $this->eloquentSelfSingleCompanyComment::where('comment_type', $forCompanyCommentType)->first();
        return $forCompanyComment;
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
        if (DB::table('likes')->where('user_id', $user_id)->where('company_id', $company_id)->exists()) {
            $isLiked = true;
        } else {
            $isLiked = false;
        }
        return $isLiked;
    }

    /**
     * お気に入り企業の追加
     *
     * @param int $student_id 学生ID
     * @param int $company_id 企業ID
     * @return void
     */
    public function addLikedCompany(int $student_id, int $company_id): void
    {
        DB::table('likes')->insert(
            ['user_id' => $student_id, 'company_id' => $company_id]
        );
    }
}
