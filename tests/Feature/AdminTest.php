<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\User;
use App\DataProvider\Eloquent\Company;
use App\DataProvider\Eloquent\FutureDiagnosisComment;
use App\DataProvider\Eloquent\SelfDiagnosisComment;
use App\DataProvider\Eloquent\FutureSingleCompanyComment;
use App\DataProvider\Eloquent\SelfSingleCompanyComment;
use App\DataProvider\Eloquent\ToFutureComment;
use App\DataProvider\Eloquent\DiagnosisQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('FutureCommentSeeder');
        $this->seed('SelfCommentSeeder');
        $this->seed('ToFutureCommentSeeder');
        $this->seed('FutureSingleCompanySeeder');
        $this->seed('SelfSingleCompanySeeder');
        $this->seed('DiagnosisQuestionSeeder');
    }

    /**
     * get dignosis text type
     * 
     * @param int $diagnosis_type
     * @return string
     */
    public function diagnosisTextType(int $diagnosis_type): string
    {
        switch ($diagnosis_type) {
            case 0:
                $diagnosis_type =  '成長意欲';
                break;
            case 1:
                $diagnosis_type =  '社会貢献';
                break;
            case 2:
                $diagnosis_type =  '安定';
                break;
            case 3:
                $diagnosis_type =  '仲間';
                break;
            case 4:
                $diagnosis_type =  '将来';
                break;
            default:
                $diagnosis_type =  '';
        }
        return $diagnosis_type;
    }

    /**
     * @test
     * App\Http\Controllers\User\AdminController
     */
    public function 表示テスト（ログイン時も含む）()
    {
        $this->get('admin/login')
            ->assertOk();
        $this->get('admin')
            ->assertRedirect('admin/login');
        $this->get('admin/diagnosis_question')
            ->assertRedirect('admin/login');
        $this->get('admin/future_comment')
            ->assertRedirect('admin/login');
        $this->get('admin/self_comment')
            ->assertRedirect('admin/login');
        $this->get('admin/diagnosis_comment')
            ->assertRedirect('admin/login');
        $this->get('admin/future_company_comment')
            ->assertRedirect('admin/login');
        $this->get('admin/self_company_comment')
            ->assertRedirect('admin/login');

        $this->loginAsAdmin();

        $this->get('admin')
            ->assertOk();
        $this->get('admin/diagnosis_question')
            ->assertOk();
        $this->get('admin/future_comment')
            ->assertOk();
        $this->get('admin/self_comment')
            ->assertOk();
        $this->get('admin/diagnosis_comment')
            ->assertOk();
        $this->get('admin/future_company_comment')
            ->assertOk();
        $this->get('admin/self_company_comment')
            ->assertOk();
    }

    /**
     * @test
     * App\Http\Controllers\User\AdminController @index
     */
    public function 管理画面表示データテスト()
    {
        $user_num = User::count();
        $company_num = Company::count();
        $this->loginAsAdmin();

        $this->get('admin')
            ->assertSee('登録者数：' . $user_num . '人')
            ->assertSee('登録者数：' . $company_num . '人');
    }

    /**
     * @test
     * App\Http\Controllers\User\AdminController
     */
    public function 質問・コメント表示データテスト()
    {
        $future_comment = FutureDiagnosisComment::first();
        $self_comment = SelfDiagnosisComment::first();
        $diagnosis_comment = ToFutureComment::first();
        $future_company_comment = FutureSingleCompanyComment::first();
        $self_company_comment = SelfSingleCompanyComment::first();
        $diagnosis_question = DiagnosisQuestion::first();
        $this->loginAsAdmin();

        $this->get('admin/future_comment')
            ->assertSee($future_comment->comment)
            ->assertSee($future_comment->comment_type);
        $this->get('admin/self_comment')
            ->assertSee($self_comment->comment)
            ->assertSee($self_comment->comment_type);
        $this->get('admin/diagnosis_comment')
            ->assertSee($diagnosis_comment->comment)
            ->assertSee($diagnosis_comment->comment_type);
        $this->get('admin/future_company_comment')
            ->assertSee($future_company_comment->comment)
            ->assertSee($future_company_comment->comment_type);
        $this->get('admin/self_company_comment')
            ->assertSee($self_company_comment->comment)
            ->assertSee($self_company_comment->comment_type);
        $this->get('admin/diagnosis_question')
            ->assertSee($diagnosis_question->question)
            ->assertSee($this->diagnosisTextType($diagnosis_question->diagnosis_type))
            ->assertSee($diagnosis_question->weight);
    }

    /**
     * @test
     * App\Http\Controllers\User\AdminController
     */
    public function 質問・コメント編集テスト()
    {
        $future_comment = FutureDiagnosisComment::first();
        $self_comment = SelfDiagnosisComment::first();
        $diagnosis_comment = ToFutureComment::first();
        $future_company_comment = FutureSingleCompanyComment::first();
        $self_company_comment = SelfSingleCompanyComment::first();
        $diagnosis_question = DiagnosisQuestion::first();
        $this->loginAsAdmin();

        $this->get('admin/diagnosis_question/edit/' . $diagnosis_question->id)
            ->assertOk();
        $this->get('admin/future_comment/edit/' . $future_comment->id)
            ->assertOk();
        $this->get('admin/self_comment/edit/' . $self_comment->id)
            ->assertOk();
        $this->get('admin/diagnosis_comment/edit/' . $diagnosis_comment->id)
            ->assertOk();
        $this->get('admin/future_company_comment/edit/' . $future_company_comment->id)
            ->assertOk();
        $this->get('admin/self_company_comment/edit/' . $self_company_comment->id)
            ->assertOk();

        $this->post(
            'admin/diagnosis_question/edit/' . $diagnosis_question->id,
            [
                'question' => "更新しました",
                'diagnosis_type' => 1,
                'weight' => 10
            ]
        );
        $this->post(
            'admin/future_comment/edit/' . $future_comment->id,
            [
                'comment' => '更新しました',
                'comment_type' => '社会貢献'
            ]
        );
        $this->post(
            'admin/self_comment/edit/' . $self_comment->id,
            [
                'comment' => '更新しました',
                'comment_type' => '社会貢献'
            ]
        );
        $this->post(
            'admin/diagnosis_comment/edit/' . $diagnosis_comment->id,
            [
                'comment' => '更新しました',
                'comment_type' => '社会貢献'
            ]
        );
        $this->post(
            'admin/future_company_comment/edit/' . $future_company_comment->id,
            [
                'comment' => '更新しました',
                'comment_type' => '社会貢献'
            ]
        );
        $this->post(
            'admin/self_company_comment/edit/' . $self_company_comment->id,
            [
                'comment' => '更新しました',
                'comment_type' => '社会貢献'
            ]
        );

        $this->get('admin/diagnosis_question')
            ->assertSee('更新しました')
            ->assertSee($this->diagnosisTextType(1))
            ->assertSee(10);
        $this->get('admin/future_comment')
            ->assertSee('更新しました');
        $this->get('admin/self_comment')
            ->assertSee('更新しました');
        $this->get('admin/diagnosis_comment')
            ->assertSee('更新しました');
        $this->get('admin/future_company_comment')
            ->assertSee('更新しました');
        $this->get('admin/self_company_comment')
            ->assertSee('更新しました');
    }

    /**
     * @test
     * App\Http\Controllers\User\AdminController
     */
    public function 質問・コメント削除()
    {
        $future_comment = FutureDiagnosisComment::first();
        $self_comment = SelfDiagnosisComment::first();
        $diagnosis_comment = ToFutureComment::first();
        $future_company_comment = FutureSingleCompanyComment::first();
        $self_company_comment = SelfSingleCompanyComment::first();
        $diagnosis_question = DiagnosisQuestion::first();
        $this->loginAsAdmin();

        $this->delete('admin/diagnosis_question/delete/' . $diagnosis_question->id);
        $this->delete('admin/future_comment/delete/' . $future_comment->id);
        $this->delete('admin/self_comment/delete/' . $self_comment->id);
        $this->delete('admin/diagnosis_comment/delete/' . $diagnosis_comment->id);
        $this->delete('admin/future_company_comment/delete/' . $future_company_comment->id);
        $this->delete('admin/self_company_comment/delete/' . $self_company_comment->id);

        $this->get('admin/future_comment')
            ->assertDontSee($future_comment->comment);
        $this->get('admin/self_comment')
            ->assertDontSee($self_comment->comment);
        $this->get('admin/diagnosis_comment')
            ->assertDontSee($diagnosis_comment->comment);
        $this->get('admin/future_company_comment')
            ->assertDontSee($future_company_comment->comment);
        $this->get('admin/self_company_comment')
            ->assertDontSee($self_company_comment->comment);
        $this->get('admin/diagnosis_question')
            ->assertDontSee($diagnosis_question->question);
    }
}
