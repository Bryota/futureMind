<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use App\Services\UserService;
use App\Services\DiagnosisServices;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\DiagnosisQuestionRequest;

class AdminController extends Controller
{
    /**
     * @var CompanyService $company CompanyServiceインスタンス
     */
    private $company;
    /**
     * @var UserService $user UserServiceインスタンス
     */
    private $user;
    /**
     * @var DiagnosisServices $diagnosis DiagnosisServicesインスタンス
     */
    private $diagnosis;

    /**
     * コンストラクタ
     *
     * @param CompanyService $company
     * @param UserService $user
     * @param DiagnosisServices $diagnosis 診断サービス
     * @return void
     */
    public function __construct(CompanyService $company, UserService $user, DiagnosisServices $diagnosis)
    {
        $this->company = $company;
        $this->user = $user;
        $this->diagnosis = $diagnosis;
    }

    /**
     * adminトップ画面表示
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $student_num = $this->user->getStudentNum();
        $company_num = $this->company->getCompanyNum();
        return view('admin.index', compact('student_num', 'company_num'));
    }

    /**
     * 理想分析コメント一覧画面表示
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function futureIndex()
    {
        $comments = $this->diagnosis->getAllFutureDiagnosisComments();
        return view('admin.future_index', compact('comments'));
    }

    /**
     * 理想分析コメント編集画面表示
     *
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function futureEdit(int $id)
    {
        $comment = $this->diagnosis->getFutureDiagnosisCommentByID($id);
        return view('admin.future_edit', compact('comment'));
    }

    /**
     * 理想分析コメント更新画面表示
     *
     * @param CommentRequest $request コメントリクエスト
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function futureUpdate(CommentRequest $request, $id)
    {
        $this->diagnosis->updateFutureComment($request, $id);
        return redirect('admin');
    }

    /**
     * 理想分析コメント削除
     *
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function futureDelete($id)
    {
        $this->diagnosis->deleteFutureComment($id);
        return redirect('admin');
    }

    /**
     * 自己分析コメント一覧画面表示
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selfIndex()
    {
        $comments = $this->diagnosis->getAllSelfDiagnosisComments();
        return view('admin.self_index', compact('comments'));
    }

    /**
     * 自己分析コメント編集画面表示
     * 
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selfEdit(int $id)
    {
        $comment = $this->diagnosis->getSelfDiagnosisCommentByID($id);
        return view('admin.self_edit', compact('comment'));
    }

    /**
     * 自己分析コメント更新画面表示
     *
     * @param CommentRequest $request コメントリクエスト
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function selfUpdate(CommentRequest $request, $id)
    {
        $this->diagnosis->updateSelfComment($request, $id);
        return redirect('admin');
    }

    /**
     * 自己分析コメント削除
     *
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function selfDelete($id)
    {
        $this->diagnosis->deleteSelfComment($id);
        return redirect('admin');
    }

    /**
     * 分析結果コメント一覧画面表示
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function diagnosisIndex()
    {
        $comments = $this->diagnosis->getAllDiagnosisComments();
        return view('admin.diagnosis_index', compact('comments'));
    }

    /**
     * 分析結果コメント編集画面表示
     * 
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function diagnosisEdit(int $id)
    {
        $comment = $this->diagnosis->getDiagnosisCommentByID($id);
        return view('admin.diagnosis_edit', compact('comment'));
    }

    /**
     * 分析結果コメント更新画面表示
     *
     * @param CommentRequest $request コメントリクエスト
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function diagnosisUpdate(CommentRequest $request, $id)
    {
        $this->diagnosis->updateDiagnosisComment($request, $id);
        return redirect('admin');
    }

    /**
     * 分析結果コメント削除
     *
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function diagnosisDelete($id)
    {
        $this->diagnosis->deleteDiagnosisComment($id);
        return redirect('admin');
    }

    /**
     * 理想分析会社コメント一覧画面表示
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function futureCompanyIndex()
    {
        $comments = $this->diagnosis->getAllFutureCompanyComments();
        return view('admin.future_company_index', compact('comments'));
    }

    /**
     * 理想分析会社コメント編集画面表示
     * 
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function futureCompanyEdit(int $id)
    {
        $comment = $this->diagnosis->getFutureCompanyCommentByID($id);
        return view('admin.future_company_edit', compact('comment'));
    }

    /**
     * 理想分析会社コメント更新画面表示
     *
     * @param CommentRequest $request コメントリクエスト
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function futureCompanyUpdate(CommentRequest $request, $id)
    {
        $this->diagnosis->updateFutureCompanyComment($request, $id);
        return redirect('admin');
    }

    /**
     * 理想分析会社コメント削除
     *
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function futureCompanyDelete($id)
    {
        $this->diagnosis->deleteFutureCompanyComment($id);
        return redirect('admin');
    }

    /**
     * 自己分析会社コメント一覧画面表示
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selfCompanyIndex()
    {
        $comments = $this->diagnosis->getAllSelfCompanyComments();
        return view('admin.self_company_index', compact('comments'));
    }

    /**
     * 自己分析会社コメント編集画面表示
     * 
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selfCompanyEdit(int $id)
    {
        $comment = $this->diagnosis->getSelfCompanyCommentByID($id);
        return view('admin.self_company_edit', compact('comment'));
    }

    /**
     * 自己分析会社コメント更新画面表示
     *
     * @param CommentRequest $request コメントリクエスト
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function selfCompanyUpdate(CommentRequest $request, $id)
    {
        $this->diagnosis->updateSelfCompanyComment($request, $id);
        return redirect('admin');
    }

    /**
     * 自己分析会社コメント削除
     *
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function selfCompanyDelete($id)
    {
        $this->diagnosis->deleteSelfCompanyComment($id);
        return redirect('admin');
    }

    /**
     * 診断質問コメント一覧画面表示
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function diagnosisQuestionIndex()
    {
        $questions = $this->diagnosis->getAllDiagnosisQuestions();
        return view('admin.diagnosis_question_index', compact('questions'));
    }

    /**
     * 診断質問コメント編集画面表示
     * 
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function diagnosisQuestionEdit(int $id)
    {
        $question = $this->diagnosis->getDiagnosisQuestionByID($id);
        return view('admin.diagnosis_question_edit', compact('question'));
    }

    /**
     * 診断質問コメント更新画面表示
     *
     * @param DiagnosisQuestionRequest $request コメントリクエスト
     * @param int $id コメントID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function diagnosisQuestionUpdate(DiagnosisQuestionRequest $request, $id)
    {
        $this->diagnosis->updateDiagnosisQuestion($request, $id);
        return redirect('admin');
    }

    /**
     * 診断質問削除
     *
     * @param int $id 質問ID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function diagnosisQuestionDelete($id)
    {
        $this->diagnosis->deleteDiagnosisQuestion($id);
        return redirect('admin');
    }
}
