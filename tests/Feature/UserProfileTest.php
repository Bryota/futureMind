<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * App\Http\Controllers\User\UserController
     */
    public function ユーザープロフィール画面ログインチェック()
    {
        $this->get('/user')
            ->assertRedirect('login');
        $this->get('/user/edit')
            ->assertRedirect('login');

        $this->loginAsUser();

        $this->get('/user')
            ->assertOk();
        $this->get('/user/edit')
            ->assertOk();
    }

    /**
     * @test
     * App\Http\Controllers\User\UserController @index
     */
    public function ユーザープロフィール初期値表示テスト()
    {
        $user = $this->loginAsUser();

        $this->get('/user')
            ->assertSee($user->title)
            ->assertSee($user->year)
            ->assertSee($user->university)
            ->assertSee($user->email);
    }

    /**
     * @test 
     * App\Http\Controllers\User\UserController @update
     */
    public function ユーザー情報を更新できる()
    {
        $this->loginAsUser();

        $postData = User::factory()->ValidUpdateData();
        $this->post('/user/edit', $postData)
            ->assertRedirect('/user');

        $postData['img_name'] = 'users/test.jpg';

        $this->assertDatabaseHas('users', $postData);
        $this->assertCount(1, User::all());


        $this->get('/user')
            ->assertSee($postData['name'])
            ->assertSee($postData['email'])
            ->assertSee($postData['year'])
            ->assertSee($postData['university'])
            ->assertSee($postData['club'])
            ->assertSee($postData['hobby'])
            ->assertSee($postData['hometown'])
            ->assertSee($postData['industry'])
            ->assertSee($postData['img_name']);
    }

    /**
     * @test
     * App\Http\Controllers\User\UserController @update
     */
    public function ユーザー情報更新バリデーション検証()
    {
        $url = '/user/edit';
        $this->loginAsUser();

        $this->from($url)->post($url, [])
            ->assertRedirect($url);

            $this->post($url, ['industry' => ''])->assertSessionHasErrors(['industry' => '志望業界は必須です。']);

            $this->post($url, ['name' => ''])->assertSessionHasErrors(['name' => '氏名は必須です。']);

            $this->post($url, ['year' => ''])->assertSessionHasErrors(['year' => '卒業年度は必須です。']);

            $this->post($url, ['club' => ''])->assertSessionHasErrors(['club' => '部活動・サークルは必須です。']);

            $this->post($url, ['university' => ''])->assertSessionHasErrors(['university' => '在学大学は必須です。']);

            $this->post($url, ['hobby' => ''])->assertSessionHasErrors(['hobby' => '趣味は必須です。']);

            $this->post($url, ['hometown' => ''])->assertSessionHasErrors(['hometown' => '出身は必須です。']);

            $this->post($url, ['email' => ''])->assertSessionHasErrors(['email' => 'メールアドレスは必須です。']);
            $this->post($url, ['email' => 'example@example@test'])->assertSessionHasErrors(['email' => 'メールアドレスには正しい形式のメールアドレスを指定してください。']);
            $this->post($url, ['email' => 'example@あああ.テスト'])->assertSessionHasErrors(['email' => 'メールアドレスには正しい形式のメールアドレスを指定してください。']);
    }
}
