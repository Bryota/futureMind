<?php

/**
 * 学生診断用の機能関連のコントローラー
 *
 * 学生診断のindexページ、aboutページ、理想分析、自己分析、診断結果、企業一覧ページ、企業個別ページ用のコントローラー
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\DiagnosisServices;
use App\Services\CompanyService;

/**
 * 診断コントローラー用のクラス
 *
 * @package App\Http\Controllers\User
 * @version 1.0
 */
class DiagnosisController extends Controller
{
    /**
     * @var DiagnosisServices $diagnosis DiagnosisServicesインスタンス
     */
    private $diagnosis;
    /**
     * @var CompanyService $company CompanyServiceインスタンス
     */
    private $company;

    /**
     * コンストラクタ
     *
     * @param DiagnosisServices $diagnosis 診断サービス
     * @param CompanyService $company 企業サービス
     * @return void
     */
    public function __construct(DiagnosisServices $diagnosis, CompanyService $company)
    {
        $this->diagnosis = $diagnosis;
        $this->company = $company;
        $this->middleware('diagnosisData');
    }

    /**
     * indexページ表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('diagnosis.index');
    }

    /**
     * aboutページ表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('user.about');
    }

    /**
     * 理想分析画面表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function future()
    {
        return view('diagnosis.future');
    }

    /**
     * 理想分析追加or更新用
     *
     * @param Request $request リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function futurePost(Request $request)
    {
        $this->diagnosis->setFutureDiagnosisForStudent(
            Auth::user()->id,
            $request->developmentvalue,
            $request->socialvalue,
            $request->stablevalue,
            $request->teammatevalue,
            $request->futurevalue
        );
        return redirect('/diagnosis/result');
    }

    /**
     * 自己分析画面表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function self()
    {
        return view('diagnosis.self');
    }

    /**
     * 自己分析追加or更新用
     *
     * @param Request $request リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function selfPost(Request $request)
    {
        $this->diagnosis->setSelfDiagnosisForStudent(
            Auth::user()->id,
            $request->developmentvalue,
            $request->socialvalue,
            $request->stablevalue,
            $request->teammatevalue,
            $request->futurevalue
        );
        return redirect('/diagnosis/result');
    }

    /**
     * 診断結果画面表示用
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function result()
    {
        if ($this->diagnosis->checkFutureDiagnosisDataExist(Auth::user()->id) <= 0) {
            return redirect('/diagnosis/future');
        }
        if ($this->diagnosis->checkSelfDiagnosisDataExist(Auth::user()->id) <= 0) {
            return redirect('/diagnosis/self');
        }
        $futureDiagnosisDataAsArray = $this->diagnosis->getFutureDiagnosisData(Auth::user()->id);
        $futureComments = $this->diagnosis->getFutureDiagnosisComments($futureDiagnosisDataAsArray);
        $selfDiagnosisDataAsArray = $this->diagnosis->getSelfDiagnosisData(Auth::user()->id);
        $selfComments = $this->diagnosis->getSelfDiagnosisComments($selfDiagnosisDataAsArray);
        $toFutureComments = $this->diagnosis->getToFutureComments($futureDiagnosisDataAsArray, $selfDiagnosisDataAsArray);
        return view('diagnosis.result', compact('futureDiagnosisDataAsArray', 'selfDiagnosisDataAsArray', 'futureComments', 'selfComments', 'toFutureComments'));
    }

    /**
     * 理想分析から選定された企業一覧画面表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function futureCompany()
    {
        $companies = $this->diagnosis->getCompaniesRelatedToFutureDiagnosisData(Auth::user()->id);
        return view('diagnosis.futureCompany', compact('companies'));
    }

    /**
     * 自己分析から選定された企業一覧画面表示用
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selfCompany()
    {
        $companies = $this->diagnosis->getCompaniesRelatedToSelfDiagnosisData(Auth::user()->id);
        return view('diagnosis.selfCompany', compact('companies'));
    }

    /**
     * 理想分析から選定された企業個別画面表示用
     *
     * @param int $id 企業ID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function futureSingleCompany(int $id)
    {
        $company = $this->company->getCompanyData($id);
        $companyComments = $this->diagnosis->getCompanyCommentForFuture($id, Auth::user()->id);
        $isLiked = $this->diagnosis->checkIsLiked(Auth::user()->id, $id);
        return view('diagnosis.futureSingleCompany', compact('company', 'companyComments', 'isLiked'));
    }

    /**
     * 自己分析から選定された企業個別画面表示用
     *
     * @param int $id 企業ID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selfSingleCompany(int $id)
    {
        $company = $this->company->getCompanyData($id);
        $companyComments = $this->diagnosis->getCompanyCommentForSelf($id, Auth::user()->id);
        $isLiked = $this->diagnosis->checkIsLiked(Auth::user()->id, $id);
        return view('diagnosis.selfSingleCompany', compact('company', 'companyComments', 'isLiked'));
    }

    /**
     * 理想分析から選定された企業お気に入り追加用
     *
     * @param Request $request リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function futureLikeCompany(Request $request)
    {
        // TODO: isliked判定のみの実装にして、企業個別ページにリダイレクトさせる
        $company = $this->company->getCompanyData($request->id);
        $companyComments = $this->diagnosis->getCompanyCommentForFuture($request->id, Auth::user()->id);
        $this->diagnosis->addLikedCompany(Auth::user()->id, $request->id);
        $isLiked = $this->diagnosis->checkIsLiked(Auth::user()->id, $request->id);
        return view('diagnosis.futureSingleCompany', compact('company', 'companyComments', 'isLiked'));
    }

    /**
     * 自己分析から選定された企業お気に入り追加用
     *
     * @param Request $request リクエスト
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selfLikeCompany(Request $request)
    {
        // TODO: isliked判定のみの実装にして、企業個別ページにリダイレクトさせる
        $company = $this->company->getCompanyData($request->id);
        $companyComments = $this->diagnosis->getCompanyCommentForSelf($request->id, Auth::user()->id);
        $this->diagnosis->addLikedCompany(Auth::user()->id, $request->id);
        $isLiked = $this->diagnosis->checkIsLiked(Auth::user()->id, $request->id);
        return view('diagnosis.selfSingleCompany', compact('company', 'companyComments', 'isLiked'));
    }
}
