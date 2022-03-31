<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyLikeUserTest extends TestCase
{
    use RefreshDatabase;

    protected $company;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('FutureCommentSeeder');
        $this->seed('SelfCommentSeeder');
        $this->seed('ToFutureCommentSeeder');
        $this->seed('FutureSingleCompanySeeder');
        $this->seed('SelfSingleCompanySeeder');
        $this->seed('DiagnosisQuestionSeeder');

        $this->company = $this->loginAsCompany();
        $diagnosisPostData = [
            'user_id' => $this->company->id,
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];
        $this->post('/company/diagnosis', $diagnosisPostData);
        $this->delete('company/logout');
    }

    /**
     * @test
     * App\Http\Controllers\company\CompanyController @student
     */
    public function 学生を見る該当なし()
    {
        $this->loginAsCompany($this->company);

        $this->get('company/student')
            ->assertOk()
            ->assertSee('お気に入りに入れた学生はまだいません');
    }

    /**
     * @test
     * App\Http\Controllers\company\CompanyController @student
     */
    public function 学生を見る理想分析からのお気に入り一覧()
    {
        $user = $this->loginAsUser();

        $futureDiagnosisPostData = [
            'user_id' => $user->id,
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];
        $selfDiagnosisPostData = [
            'user_id' => $user->id,
            'developmentvalue' => 3,
            'socialvalue' => 3,
            'stablevalue' => 3,
            'teammatevalue' => 3,
            'futurevalue' => 3
        ];

        $this->post('/diagnosis/future', $futureDiagnosisPostData);
        $this->post('/diagnosis/self', $selfDiagnosisPostData);
        $this->post('diagnosis/futureSingleCompany/' . $this->company->id, ['company_id' => $this->company->id]);

        $this->loginAsCompany($this->company);

        $this->get('company/student')
            ->assertOk()
            ->assertSee($user->name);
    }

    /**
     * @test
     * App\Http\Controllers\company\CompanyController @student
     */
    public function 学生を見る自己分析からのお気に入り一覧()
    {
        $user = $this->loginAsUser();

        $futureDiagnosisPostData = [
            'user_id' => $user->id,
            'developmentvalue' => 3,
            'socialvalue' => 3,
            'stablevalue' => 3,
            'teammatevalue' => 3,
            'futurevalue' => 3
        ];
        $selfDiagnosisPostData = [
            'user_id' => $user->id,
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];

        $this->post('/diagnosis/future', $futureDiagnosisPostData);
        $this->post('/diagnosis/self', $selfDiagnosisPostData);
        $this->post('diagnosis/selfSingleCompany/' . $this->company->id, ['company_id' => $this->company->id]);

        $this->loginAsCompany($this->company);

        $this->get('company/student')
            ->assertOk()
            ->assertSee($user->name);
    }

    /**
     * @test
     * App\Http\Controllers\company\CompanyController @student
     */
    public function 学生を見る検索結果からのお気に入り一覧()
    {
        $user = $this->loginAsUser();

        $this->post('search/company/' . $this->company->id, ['company_id' => $this->company->id]);

        $this->loginAsCompany($this->company);

        $this->get('company/student')
            ->assertOk()
            ->assertSee($user->name);
    }

    /**
     * @test
     * App\Http\Controllers\company\CompanyController @singleStudent
     */
    public function 学生個人ページ理想分析からのお気に入り()
    {
        $user = $this->loginAsUser();

        $futureDiagnosisPostData = [
            'user_id' => $user->id,
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];
        $selfDiagnosisPostData = [
            'user_id' => $user->id,
            'developmentvalue' => 3,
            'socialvalue' => 3,
            'stablevalue' => 3,
            'teammatevalue' => 3,
            'futurevalue' => 3
        ];

        $this->post('/diagnosis/future', $futureDiagnosisPostData);
        $this->post('/diagnosis/self', $selfDiagnosisPostData);
        $this->post('diagnosis/futureSingleCompany/' . $this->company->id, ['company_id' => $this->company->id]);

        $this->loginAsCompany($this->company);

        $this->get('company/student/' . $user->id)
            ->assertOk()
            ->assertSee($user->name)
            ->assertSee($user->year)
            ->assertSee($user->university)
            ->assertSee($user->email)
            ->assertSee('チャット作成');
    }

    /**
     * @test
     * App\Http\Controllers\company\CompanyController @singleStudent
     */
    public function 学生個人ページ自己分析からのお気に入り()
    {
        $user = $this->loginAsUser();

        $futureDiagnosisPostData = [
            'user_id' => $user->id,
            'developmentvalue' => 3,
            'socialvalue' => 3,
            'stablevalue' => 3,
            'teammatevalue' => 3,
            'futurevalue' => 3
        ];
        $selfDiagnosisPostData = [
            'user_id' => $user->id,
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];

        $this->post('/diagnosis/future', $futureDiagnosisPostData);
        $this->post('/diagnosis/self', $selfDiagnosisPostData);
        $this->post('diagnosis/selfSingleCompany/' . $this->company->id, ['company_id' => $this->company->id]);

        $this->loginAsCompany($this->company);

        $this->get('company/student/' . $user->id)
            ->assertOk()
            ->assertSee($user->name)
            ->assertSee($user->year)
            ->assertSee($user->university)
            ->assertSee($user->email)
            ->assertSee('チャット作成');
    }

    /**
     * @test
     * App\Http\Controllers\company\CompanyController @singleStudent
     */
    public function 学生個人ページ検索結果からのお気に入り()
    {
        $user = $this->loginAsUser();

        $this->post('search/company/' . $this->company->id, ['company_id' => $this->company->id]);

        $this->loginAsCompany($this->company);

        $this->get('company/student/' . $user->id)
            ->assertOk()
            ->assertSee($user->name)
            ->assertSee($user->year)
            ->assertSee($user->university)
            ->assertSee($user->email)
            ->assertSee('チャット作成');
    }
}
