<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\ChatRoom;
use App\DataProvider\Eloquent\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserChatTest extends TestCase
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

        $this->post('search/company/' . $this->company->id, ['company_id' => $this->company->id]);
    }

    /**
     * @test
     * App\Http\Controllers\User\UserController @chat
     */
    public function チャットルーム表示テスト()
    {
        $this->company = $this->loginAsCompany($this->company);
        $this->from('company/student/' . $this->user->id)->post('company/chat', ['student_id' => $this->user->id])
            ->assertRedirect('company/student/' . $this->user->id);
        $this->delete('company/logout');

        $this->loginAsUser($this->user);

        $this->get('search/company/' . $this->company->id)
            ->assertOk()
            ->assertSee('チャット');

        $chat_room = ChatRoom::first();

        $this->get('user/chat/' . $chat_room->id)
            ->assertOk()
            ->assertSee($this->company->name)
            ->assertSee('あなた');
    }

    /**
     * @test
     * App\Http\Controllers\User\UserController @postMessage
     */
    public function チャット送信()
    {
        $this->company = $this->loginAsCompany($this->company);
        $this->from('company/student/' . $this->user->id)->post('company/chat', ['student_id' => $this->user->id]);
        $this->delete('company/logout');

        $chat_room = ChatRoom::first();

        $this->user = $this->loginAsUser($this->user);
        $this->post('user/chat/' . $chat_room->id, ['message' => 'テストメッセージ', 'room_id' => $chat_room->id]);

        $this->assertCount(1, Message::all());
        $this->assertDatabaseHas(
            'messages',
            [
                'user_id' => $chat_room->user_id,
                'company_id' => null,
                'room_id' => $chat_room->id,
                'message' => 'テストメッセージ'
            ]
        );
    }

    /**
     * @test
     * App\Http\Controllers\User\UserController @getMessages
     */
    public function チャット情報取得()
    {
        $this->company = $this->loginAsCompany($this->company);
        $this->from('company/student/' . $this->user->id)->post('company/chat', ['student_id' => $this->user->id]);
        $this->delete('company/logout');

        $chat_room = ChatRoom::first();

        $this->user = $this->loginAsUser($this->user);
        $this->post('user/chat/' . $chat_room->id, ['message' => 'テストメッセージ', 'room_id' => $chat_room->id]);

        $this->get('user/chat/ajax/' . $chat_room->id . '?student_id=' . $this->user->id)
            ->assertJsonFragment(['company_id' => null, 'message' => "テストメッセージ", "user_id" => $this->user->id]);
    }

    /**
     * @test
     * App\Http\Middleware\CompanyUncheckedMessageMiddleware
     */
    public function 新着チャットアラート()
    {
        $this->company = $this->loginAsCompany($this->company);
        $this->from('company/student/' . $this->user->id)->post('company/chat', ['student_id' => $this->user->id]);
        $this->delete('company/logout');

        $chat_room = ChatRoom::first();
        $this->company = $this->loginAsCompany($this->company);
        $this->post('company/chat/' . $chat_room->id, ['message' => 'テストメッセージ', 'room_id' => $chat_room->id]);
        $this->delete('company/logout');

        $this->loginAsUser($this->user);

        $this->get('/')
            ->assertSee('<span></span>', false);
        $this->get('user/likes')
            ->assertSee('<span>1</span>', false);

        $this->get('user/chat/' . $chat_room->id);

        $this->get('/')
            ->assertDontSee('<span></span>', false);
        $this->get('user/likes')
            ->assertDontSee('<span>1</span>', false);
    }
}
