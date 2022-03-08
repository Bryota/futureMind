<?php
/**
 * 企業用のデータリポジトリ
 *
 * DBから企業データの取得・更新、検索企業の取得、お気に入りされた学生の取得を担っている
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\DataProvider;

use App\DataProvider\RepositoryInterface\CompanyRepositoryInterface;
use App\DataProvider\Eloquent\Company as EloquentCompany;
use App\DataProvider\Eloquent\ChatRoom as EloquentChatRoom;
use App\DataProvider\Eloquent\CompanyDiagnosisData as EloquentCompanyDiagnosisData;
use App\Domain\Entity\CompanyDiagnosisData;
use Illuminate\Support\Facades\DB;
use App\Domain\Entity\Company;

/**
 * 企業リポジトリクラス
 *
 * @package App\DataProvider
 * @version 1.0
 */
class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @var EloquentCompany $eloquentCompany CompanyEloquentModel
     */
    private $eloquentCompany;
    /**
     * @var EloquentChatRoom $eloquentChatRoom ChatRoomEloquentModel
     */
    private $eloquentChatRoom;
    /**
     * @var \Illuminate\Database\Query\Builder $likesTable likesTableクエリビルダ
     */
    private $likesTable;

    /**
     * コンストラクタ
     *
     * @param EloquentCompany $company CompanyEloquentModel
     * @param EloquentChatRoom $chatRoom ChatRoomEloquentModel
     * @param EloquentCompanyDiagnosisData $companyDiagnosisData CompanyDiagnosisDataEloquentModel
     * @return void
     */
    public function __construct(EloquentCompany $company, EloquentChatRoom $chatRoom, EloquentCompanyDiagnosisData $companyDiagnosisData)
    {
        $this->eloquentCompany = $company;
        $this->eloquentChatRoom = $chatRoom;
        $this->eloquentCompanyDiagnosisData = $companyDiagnosisData;
        $this->likesTable = DB::table('likes');
    }

    /**
     * 企業データの取得
     *
     * @param int $id 企業ID
     * @return object 企業データ
     */
    public function getCompanyDataById(int $id): object
    {
        $comapnyData = $this->eloquentCompany::find($id);
        return $comapnyData;
    }

    /**
     * 検索企業一覧データの取得
     *
     * @param $employee 従業員数データ
     * @param $industry 業界データ
     * @param $area 住所データ
     * @param $developmentValue 成長意欲データ
     * @param $socialValue 社会貢献データ
     * @param $stableValue 安定データ
     * @param $teammateValue 仲間データ
     * @param $futureValue 将来性データ
     * @return object 検索企業一覧データ
     */
    public function getSearchedCompanies($employee, $industry, $area, $developmentValue, $socialValue, $stableValue, $teammateValue, $futureValue): object
    {
        // 業種・地域・規模が当てはまり、詳細条件のどれか1つが当てはまるものを検索
        $companies = $this->eloquentCompany::where('industry',$industry)
            ->Where('office','LIKE',"%{$area}%")
            ->WhereBetween('employee',$employee)
            ->whereHas('diagnosis',function($query) use($developmentValue,$socialValue,$stableValue,$teammateValue,$futureValue){
                $query->where('developmentvalue',$developmentValue);
                $query->orWhere('socialvalue',$socialValue);
                $query->orWhere('stablevalue',$stableValue);
                $query->orWhere('teammatevalue',$teammateValue);
                $query->orWhere('futurevalue',$futureValue);
            })
            ->paginate(6);
        return $companies;
    }

    /**
     * 企業データの更新
     *
     * @param Company $company 企業データ
     * @param int $company_id 企業ID
     * @return void
     */
    public function updateCompanyData(Company $company, int $company_id, $file): void
    {
        $eloquent = $this->eloquentCompany::find($company_id);
        $eloquent->name = $company->getName();
        $eloquent->industry = $company->getIndustry();
        $eloquent->office = $company->getOffice();
        $eloquent->employee = $company->getEmployee();
        $eloquent->homepage = $company->getHomepage();
        $eloquent->comment = $company->getComment();
        if(isset($file)){
            $eloquent->company_icon = 'companies/' . $file->getClientOriginalName();
        }
        $eloquent->save();
    }

    /**
     * 企業診断データの追加or更新
     *
     * @param CompanyDiagnosisData $companyDiagnosisData 企業診断データ
     * @param int $company_id 企業ID
     * @return void
     */
    public function setCompanyDiagnosisData(CompanyDiagnosisData $companyDiagnosisData, int $company_id): void
    {
        if ($this->eloquentCompanyDiagnosisData::where('user_id',$company_id)->first() === null) {
            $eloquent = $this->eloquentCompanyDiagnosisData->newInstance();
            $eloquent->developmentvalue = $companyDiagnosisData->getDevelopmentValue()/3;
            $eloquent->socialvalue = $companyDiagnosisData->getSocialValue()/3;
            $eloquent->stablevalue = $companyDiagnosisData->getStableValue()/3;
            $eloquent->teammatevalue = $companyDiagnosisData->getTeammateValue()/3;
            $eloquent->futurevalue = $companyDiagnosisData->getFutureValue()/3;
            $eloquent->user_id = $companyDiagnosisData->getCompanyId();
            $eloquent->save();
        } else {
            $eloquent = $this->eloquentCompanyDiagnosisData::where('user_id',$company_id)->first();
            $eloquent->developmentvalue = $companyDiagnosisData->getDevelopmentValue()/3;
            $eloquent->socialvalue = $companyDiagnosisData->getSocialValue()/3;
            $eloquent->stablevalue = $companyDiagnosisData->getStableValue()/3;
            $eloquent->teammatevalue = $companyDiagnosisData->getTeammateValue()/3;
            $eloquent->futurevalue = $companyDiagnosisData->getFutureValue()/3;
            $eloquent->save();
        }
    }

    /**
     * お気に入りされた学生一覧データの取得
     *
     * @param int $company_id 企業ID
     * @return object お気に入りされた学生一覧データ
     */
    public function getLikedStudents(int $company_id): object
    {
        $students = $this->eloquentCompany::find($company_id)->likesStudent()->paginate(6);
        return $students;
    }
}
