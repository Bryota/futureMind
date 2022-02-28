<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\ChatRoom;
use App\DataProvider\Eloquent\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyChatTest extends TestCase
{
    use RefreshDatabase;

    protected $company;
    protected $user;


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

        $this->user = $this->loginAsUser();

        $this->post('search/company/'.$this->company->id, ['company_id' => $this->company->id]);
    }

    /**
     * @test
     * App\Http\Controllers\company\CompanyController @createChatRoom
     */
    public function チャットルーム作成()
    {
        $this->company = $this->loginAsCompany($this->company);

        $this->from('company/student/'.$this->user->id)->post('company/chat', ['student_id' => $this->user->id])
            ->assertRedirect('company/student/'.$this->user->id);

        $this->get('company/student/'.$this->user->id)
            ->assertSee('チャット');

        $this->assertCount(1, ChatRoom::all());
        $this->assertDatabaseHas('chat_rooms', ['user_id' => $this->user->id, 'company_id' => $this->company->id]);
    }

    /**
     * @test
     * App\Http\Controllers\company\CompanyController @chat
     */
    public function チャットルーム表示テスト()
    {
        $this->company = $this->loginAsCompany($this->company);

        $this->from('company/student/'.$this->user->id)->post('company/chat', ['student_id' => $this->user->id]);

        $chat_room = ChatRoom::first();

        $this->get('company/chat/'.$chat_room->id.'?student_id='.$this->user->id)
            ->assertOk()
            ->assertSee($this->user->name)
            ->assertSee('あなた');
    }

    /**
     * @test
     * App\Http\Controllers\company\CompanyController @postMessage
     */
    public function チャット送信()
    {
        $this->company = $this->loginAsCompany($this->company);

        $this->from('company/student/'.$this->user->id)->post('company/chat', ['student_id' => $this->user->id]);

        $chat_room = ChatRoom::first();

        $this->post('company/chat/'.$chat_room->id, ['message' => 'テストメッセージ', 'room_id' => $chat_room->id]);

        $this->assertCount(1, Message::all());
        $this->assertDatabaseHas('messages', [
                                                'student_user' => 0,
                                                'company_user' => $this->company->id,
                                                'room_id' => $chat_room->id,
                                                'message' => 'テストメッセージ'
                                            ]
        );
    }
}
