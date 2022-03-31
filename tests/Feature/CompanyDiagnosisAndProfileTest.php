<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\Company;
use App\DataProvider\Eloquent\CompanyDiagnosisData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyDiagnosisAndProfileTest extends TestCase
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
     * @test
     * App\Http\Controllers\Company\CompanyController
     */
    public function ページ表示テスト()
    {
        $this->get('/company')
            ->assertRedirect('/company/login');
        $this->get('/company/diagnosis')
            ->assertRedirect('/company/login');

        $company = $this->loginAsCompany();

        $this->get('/company')
            ->assertRedirect('/company/diagnosis');
        $this->get('/company/diagnosis')
            ->assertOk();;

        CompanyDiagnosisData::factory()->userAs($company)->create();

        $this->get('/company')
            ->assertOk();
        $this->get('/company/edit')
            ->assertOk();
    }

    /**
     * @test
     * App\Http\Controllers\Company\CompanyController
     */
    public function 診断ページ表示テスト()
    {
        $company = $this->loginAsCompany();

        $diagnosisPostData = [
            'user_id' => $company->id,
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];

        $this->post('/company/diagnosis', $diagnosisPostData)
            ->assertRedirect('/company');

        $this->get('/company')
            ->assertOk();
    }

    /**
     * @test
     * App\Http\Controllers\Company\CompanyController @diagnosis
     */
    public function 診断結果ページ表示テスト()
    {
        $company = $this->loginAsCompany();

        $diagnosisPostData = [
            'user_id' => $company->id,
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];

        $this->post('/company/diagnosis', $diagnosisPostData)
            ->assertRedirect('/company');

        $this->get('/company')
            ->assertOk()
            ->assertSee($company->name)
            ->assertSee($company->industry)
            ->assertSee($company->office)
            ->assertSee($company->employee)
            ->assertSee($company->homepage)
            ->assertSee($company->comment);
    }

    /**
     * @test
     * App\Http\Controllers\Company\CompanyController @update
     */
    public function 企業情報更新ができる()
    {
        $company = $this->loginAsCompany();
        CompanyDiagnosisData::factory()->userAs($company)->create();

        $postData = Company::factory()->ValidUpdateData();

        $this->post('/company/edit', $postData)
            ->assertRedirect('/company');

        unset($postData['company_icon']);

        $this->assertDatabaseHas('companies', $postData);
        $this->assertCount(1, Company::all());

        $this->get('/company')
            ->assertSee($postData['name'])
            ->assertSee($postData['industry'])
            ->assertSee($postData['office'])
            ->assertSee($postData['employee'])
            ->assertSee($postData['homepage'])
            ->assertSee($postData['comment']);
    }

    /**
     * @test
     * App\Http\Controllers\Company\CompanyController @update
     */
    public function 企業情報更新バリデーション検証()
    {
        $url = '/company/edit';

        $company = $this->loginAsCompany();
        CompanyDiagnosisData::factory()->userAs($company)->create();

        $this->from($url)->post($url, [])
            ->assertRedirect($url);

        $this->post($url, ['industry' => ''])->assertSessionHasErrors(['industry' => '志望業界は必須です。']);

        $this->post($url, ['name' => ''])->assertSessionHasErrors(['name' => '氏名は必須です。']);

        $this->post($url, ['office' => ''])->assertSessionHasErrors(['office' => '場所は必須です。']);

        $this->post($url, ['employee' => ''])->assertSessionHasErrors(['employee' => '社員数は必須です。']);
        $this->post($url, ['employee' => 'あああ'])->assertSessionHasErrors(['employee' => '社員数には整数を指定してください。']);

        $this->post($url, ['homepage' => ''])->assertSessionHasErrors(['homepage' => 'ホームページは必須です。']);
        $this->post($url, ['homepage' => 'あああ'])->assertSessionHasErrors(['homepage' => 'ホームページには正しい形式のURLを指定してください。']);

        $this->post($url, ['comment' => ''])->assertSessionHasErrors(['comment' => '企業からのコメントは必須です。']);
    }
}
