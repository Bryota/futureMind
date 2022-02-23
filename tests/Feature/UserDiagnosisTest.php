<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\FutureDiagnosisData;
use App\DataProvider\Eloquent\SelfDiagnosisData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
}
