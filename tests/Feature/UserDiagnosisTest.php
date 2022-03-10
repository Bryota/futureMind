<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\Company;
use App\DataProvider\Eloquent\FutureDiagnosisData;
use App\DataProvider\Eloquent\SelfDiagnosisData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserDiagnosisTest extends TestCase
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
    }
    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController
     */
    public function ページ表示テスト()
    {
        $this->get('/')
            ->assertRedirect('/login');
        $this->get('/about')
            ->assertRedirect('/login');
        $this->get('/diagnosis/future')
            ->assertRedirect('/login');
        $this->get('/diagnosis/self')
            ->assertRedirect('/login');
        $this->get('/diagnosis/result')
            ->assertRedirect('/login');
        $this->get('/diagnosis/selfCompany')
            ->assertRedirect('/login');
        $this->get('/diagnosis/futureCompany')
            ->assertRedirect('/login');

        $this->loginAsUser();

        $this->get('/')
            ->assertOk();
        $this->get('/about')
            ->assertOk();
        $this->get('/diagnosis/future')
            ->assertOk();
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController
     */
    public function 診断ページ表示テスト()
    {
        $user = $this->loginAsUser();

        $diagnosisPostData = [
            'user_id' => $user->id,
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];

        $this->get('/diagnosis/result')
            ->assertRedirect('/diagnosis/future');

        $this->post('/diagnosis/future', $diagnosisPostData)
            ->assertRedirect('/diagnosis/result');

        $this->get('/diagnosis/result')
            ->assertRedirect('/diagnosis/self');

        $this->post('/diagnosis/self', $diagnosisPostData)
            ->assertRedirect('/diagnosis/result');

        $this->get('/diagnosis/result')
            ->assertOk();
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController @result
     */
    public function 診断結果ページ表示テスト()
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
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];

        $this->post('/diagnosis/future', $futureDiagnosisPostData);

        $this->post('/diagnosis/self', $selfDiagnosisPostData);

        $this->get('/diagnosis/result')
            ->assertOk()
            ->assertSee('成長意欲')
            ->assertSee('社会貢献')
            ->assertSee('安定')
            ->assertSee('仲間')
            ->assertSee('将来性');
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController @futureCompany
     */
    public function 理想分析から選定された企業一覧該当企業なし()
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
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];

        $this->post('/diagnosis/future', $futureDiagnosisPostData);
        $this->post('/diagnosis/self', $selfDiagnosisPostData);

        $this->get('diagnosis/futureCompany')
            ->assertOk()
            ->assertSee('オススメの企業は見つかりませんでし。');
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController @selfCompany
     */
    public function 自己分析から選定された企業一覧該当企業なし()
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
            'developmentvalue' => 15,
            'socialvalue' => 15,
            'stablevalue' => 15,
            'teammatevalue' => 15,
            'futurevalue' => 15
        ];

        $this->post('/diagnosis/future', $futureDiagnosisPostData);
        $this->post('/diagnosis/self', $selfDiagnosisPostData);

        $this->get('diagnosis/selfCompany')
            ->assertOk()
            ->assertSee('オススメの企業は見つかりませんでした。');
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController @futureCompany
     */
    public function 理想分析から選定された企業一覧該当企業あり()
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
        $this->post('/company/diagnosis', $diagnosisPostData);
        $this->delete('company/logout');

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

        $this->get('diagnosis/futureCompany')
            ->assertOk()
            ->assertSee($company->title);
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController @selfCompany
     */
    public function 自己分析から選定された企業一覧該当企業あり()
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
        $this->post('/company/diagnosis', $diagnosisPostData);
        $this->delete('company/logout');

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

        $this->get('diagnosis/selfCompany')
            ->assertOk()
            ->assertSee($company->title);
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController @futureCompany
     */
    public function 理想分析おすすめ企業()
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
        $this->post('/company/diagnosis', $diagnosisPostData);
        $this->delete('company/logout');

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

        $this->get('diagnosis/futureSingleCompany/'.$company->id)
            ->assertOk()
            ->assertOk('なし')
            ->assertOk($company->name)
            ->assertOk($company->industry)
            ->assertOk($company->office)
            ->assertOk($company->employee)
            ->assertOk($company->homepage)
            ->assertOk($company->comment);
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController @futureCompany
     */
    public function 自己分析おすすめ企業()
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
        $this->post('/company/diagnosis', $diagnosisPostData);
        $this->delete('company/logout');

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

        $this->get('diagnosis/selfSingleCompany/'.$company->id)
            ->assertOk()
            ->assertOk('成長意欲')
            ->assertOk('社会貢献')
            ->assertOk('安定')
            ->assertOk('仲間')
            ->assertOk('将来性')
            ->assertOk($company->name)
            ->assertOk($company->industry)
            ->assertOk($company->office)
            ->assertOk($company->employee)
            ->assertOk($company->homepage)
            ->assertOk($company->comment);
    }
}
