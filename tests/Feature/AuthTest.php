<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * App\Http\Controllers\Auth\RegisterController @register
     */
    public function ユーザー登録ができる()
    {
        $this->get('register')
            ->assertOk();

        $validData = User::factory()->validData();
        $this->post(route('register'), $validData)
            ->assertStatus(302);

        unset($validData['password']);

        $this->assertDatabaseHas('users', $validData);

        $user = User::firstWhere($validData);

        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     * @test
     * App\Http\Controllers\Auth\RegisterController @register
     */
    public function ユーザー登録バリデーション検証()
    {
        $url = 'register';

        $this->from('register')->post($url, [])
            ->assertRedirect($url);

        $this->post($url, ['name' => ''])->assertSessionHasErrors(['name' => '氏名は必須です。']);
        $this->post($url, ['name' => str_repeat('あ', 256)])->assertSessionHasErrors(['name' => '氏名には255文字以下の文字列を指定してください。']);
        $this->post($url, ['name' => str_repeat('あ', 255)])->assertSessionDoesntHaveErrors(['name' => '氏名には255文字以下の文字列を指定してください。']);

        $this->post($url, ['year' => ''])->assertSessionHasErrors(['year' => '卒業年度は必須です。']);

        $this->post($url, ['university' => ''])->assertSessionHasErrors(['university' => '在学大学は必須です。']);

        $this->post($url, ['email' => ''])->assertSessionHasErrors(['email' => 'メールアドレスは必須です。']);
        $this->post($url, ['email' => 'example@example@test'])->assertSessionHasErrors(['email' => 'メールアドレスには正しい形式のメールアドレスを指定してください。']);
        $this->post($url, ['email' => 'example@あああ.テスト'])->assertSessionHasErrors(['email' => 'メールアドレスには正しい形式のメールアドレスを指定してください。']);

        User::factory()->create(['email' => 'test@example.com']);
        $this->post($url, ['email' => 'test@example.com'])->assertSessionHasErrors(['email' => 'そのメールアドレスはすでに使われています。']);

        $this->post($url, ['password' => ''])->assertSessionHasErrors(['password' => 'パスワードは必須です。']);
        $this->post($url, ['password' => str_repeat('あ', 7)])->assertSessionHasErrors(['password' => 'パスワードには8文字以上の文字列を指定してください。']);
        $this->post($url, ['password' => str_repeat('あ', 8)])->assertSessionDoesntHaveErrors(['password' => 'パスワードには8文字以上の文字列を指定してください。']);
    }
}
