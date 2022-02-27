<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;


class UserLikeCompanyTest extends TestCase
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
     * App\Http\Controllers\User\UserController @likesCompany
     */
    public function お気に入り企業表示テスト該当なし()
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

        $this->get('/user/likes')
            ->assertOk()
            ->assertSee('お気に入りの企業がありません。');
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController @futureLikeCompany
     */
    public function 理想分析お気に入り企業追加()
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

        $this->post('diagnosis/futureSingleCompany/'.$this->company->id, ['company_id' => $this->company->id])
            ->assertOk()
            ->assertSee('お気に入りに追加済み');

        $this->get('/user/likes')
            ->assertOk()
            ->assertSee($this->company->name);

        $this->assertDatabaseHas('likes', ['user_id' => $user->id, 'company_id' => $this->company->id]);
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController @futureLikeCompany
     */
    public function 自己分析お気に入り企業追加()
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

        $this->post('diagnosis/selfSingleCompany/'.$this->company->id, ['company_id' => $this->company->id])
            ->assertOk()
            ->assertSee('お気に入りに追加済み');

        $this->get('/user/likes')
            ->assertOk()
            ->assertSee($this->company->name);

        $this->assertDatabaseHas('likes', ['user_id' => $this->company->id, 'company_id' => $this->company->id]);
    }

    /**
     * @test
     * App\Http\Controllers\User\DiagnosisController @futureLikeCompany
     */
    public function 検索結果お気に入り企業追加()
    {
        $user = $this->loginAsUser();

        $this->post('search/company/'.$this->company->id, ['company_id' => $this->company->id])
            ->assertOk()
            ->assertSee('お気に入りに追加済み');

        $this->assertDatabaseHas('likes', ['user_id' => $user->id, 'company_id' => $this->company->id]);
    }
}
