<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\Company;
use App\DataProvider\Eloquent\CompanyDiagnosisData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchCompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * App\Http\Controllers\User\SearchCompanyController
     */
    public function ページ表示テスト()
    {
        $this->get('/search')
            ->assertRedirect('/login');
        $this->get('/search/result')
            ->assertRedirect('/login');

        $this->loginAsUser();

        $this->get('/search')
            ->assertOk();
    }

    /**
     * @test
     * App\Http\Controllers\User\SearchCompanyController @searchPost
     */
    public function 企業検索該当なし()
    {
        $this->loginAsUser();

        $postData = [
            'employee' => '~50',
            'industry' => 'メーカー',
            'area' => '東京都',
            'development' => 1,
            'social' => 1,
            'stable' => 1,
            'teammate' => 1,
            'future' => 1
        ];
        $this->post('/search/result', $postData)
            ->assertOk()
            ->assertSee('該当の企業は見つかりませんでした。');
    }

    /**
     * @test
     * App\Http\Controllers\User\SearchCompanyController @searchPost
     */
    public function 企業検索該当あり()
    {
        $this->loginAsUser();

        $companyData = [
            'employee' => 30,
            'industry' => 'メーカー',
            'office' => '東京都テスト区テスト11-1',
        ];

        $companyDiagnosisData = [
            'developmentvalue' => 1,
            'socialvalue' => 1,
            'stablevalue' => 1,
            'teammatevalue' => 1,
            'futurevalue' => 1
        ];

        $postData = [
            'employee' => '~50',
            'industry' => 'メーカー',
            'area' => '東京都',
            'development' => 1,
            'social' => 1,
            'stable' => 1,
            'teammate' => 1,
            'future' => 1
        ];

        $company = Company::factory()->create($companyData);
        CompanyDiagnosisData::factory()->userAs($company)->create($companyDiagnosisData);
        $this->post('/search/result', $postData)
            ->assertOk()
            ->assertSee($company->name);
    }

    /**
     * @test
     * App\Http\Controllers\User\SearchCompanyController @single
     */
    public function 企業検索個別ページ表示テスト()
    {
        $this->loginAsUser();

        $companyData = [
            'employee' => 30,
            'industry' => 'メーカー',
            'office' => '東京都テスト区テスト11-1',
        ];

        $companyDiagnosisData = [
            'developmentvalue' => 1,
            'socialvalue' => 1,
            'stablevalue' => 1,
            'teammatevalue' => 1,
            'futurevalue' => 1
        ];

        $company = Company::factory()->create($companyData);
        CompanyDiagnosisData::factory()->userAs($company)->create($companyDiagnosisData);

        $this->get('/search/company/'.$company->id)
            ->assertOk()
            ->assertSee($company->name)
            ->assertSee($company->industry)
            ->assertSee($company->office)
            ->assertSee($company->employee)
            ->assertSee($company->homepage)
            ->assertSee($company->comment);
    }
}
