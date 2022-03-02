<?php

namespace Tests\Feature;

use App\DataProvider\Eloquent\User;
use App\DataProvider\Eloquent\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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

    /**
     * @test
     * App\Http\Controllers\Auth\LoginController @login
     */
    public function ユーザーログインができる()
    {
        $postData = [
            'email' => 'example@example.com',
            'password' => 'password'
        ];

        $dbData = [
            'name' => 'user',
            'email' => 'example@example.com',
            'year' => '2022年',
            'university' => 'テスト大学',
            'password' => bcrypt('password')
        ];

        $this->get('login')
            ->assertOk();

        $user = User::factory()->create($dbData);

        $this->post('login', $postData)
            ->assertRedirect('/');

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     * App\Http\Controllers\Auth\LoginController @login
     */
    public function ユーザーログインバリデーション検証()
    {
        $url = 'login';

        $this->from($url)->post($url, [])
            ->assertRedirect($url);

        $this->post($url, ['email' => ''])->assertSessionHasErrors(['email' => 'メールアドレスは必須です。']);

        $this->post($url, ['password' => ''])->assertSessionHasErrors(['password' => 'パスワードは必須です。']);
    }

    /**
     * @test
     * App\Http\Controllers\Auth\LoginController @login
     */
    public function ユーザーログインエラー()
    {
        $url = 'login';

        $postData = [
            'email' => 'example@example.com',
            'password' => 'password123'
        ];

        $dbData = [
            'name' => 'user',
            'email' => 'example@example.com',
            'year' => '2022年',
            'university' => 'テスト大学',
            'password' => bcrypt('password')
        ];

        User::factory()->create($dbData);

        $this->from($url)->post($url, $postData)
            ->assertRedirect($url)
            ->assertSessionHasErrors(['email' => '認証情報が記録と一致しません。']);
    }

    /**
     * @test
     * App\Http\Controllers\Auth\LoginController @createCompany
     */
    public function 企業登録ができる()
    {
        $url = 'company/register';

        $this->get($url)
            ->assertOk();

        $validData = Company::factory()->validData();
        $this->post($url, $validData)
            ->assertStatus(302);

        unset($validData['password']);
        $validData['company_icon'] = 'companies/test.jpg';
        $this->assertDatabaseHas('companies', $validData);

        $company = Company::firstWhere($validData);

        $this->assertTrue(Hash::check('password', $company->password));
    }

    /**
     * @test
     * App\Http\Controllers\Auth\LoginController @createCompany
     */
    public function 企業登録バリデーション検証()
    {
        $url = 'company/register';

        $this->from($url)->post($url, [])
            ->assertRedirect($url);

            $this->post($url, ['name' => ''])->assertSessionHasErrors(['name' => '氏名は必須です。']);
            $this->post($url, ['name' => str_repeat('あ', 256)])->assertSessionHasErrors(['name' => '氏名には255文字以下の文字列を指定してください。']);
            $this->post($url, ['name' => str_repeat('あ', 255)])->assertSessionDoesntHaveErrors(['name' => '氏名には255文字以下の文字列を指定してください。']);

            $this->post($url, ['company_icon' => ''])->assertSessionHasErrors(['company_icon' => 'アイコンは必須です。']);

            $this->post($url, ['email' => ''])->assertSessionHasErrors(['email' => 'メールアドレスは必須です。']);
            $this->post($url, ['email' => 'example@example@test'])->assertSessionHasErrors(['email' => 'メールアドレスには正しい形式のメールアドレスを指定してください。']);
            $this->post($url, ['email' => 'example@あああ.テスト'])->assertSessionHasErrors(['email' => 'メールアドレスには正しい形式のメールアドレスを指定してください。']);
    
            Company::factory()->create(['email' => 'test@example.com']);
            $this->post($url, ['email' => 'test@example.com'])->assertSessionHasErrors(['email' => 'そのメールアドレスはすでに使われています。']);

            $this->post($url, ['password' => ''])->assertSessionHasErrors(['password' => 'パスワードは必須です。']);
            $this->post($url, ['password' => str_repeat('あ', 7)])->assertSessionHasErrors(['password' => 'パスワードには8文字以上の文字列を指定してください。']);
            $this->post($url, ['password' => str_repeat('あ', 8)])->assertSessionDoesntHaveErrors(['password' => 'パスワードには8文字以上の文字列を指定してください。']);
    }

    /**
     * @test
     * App\Http\Controllers\Auth\LoginController @CompanyLogin
     */
    public function 企業ログインができる()
    {
        $postData = [
            'email' => 'example@example.com',
            'password' => 'password'
        ];

        $dbData = [
            'name' => 'user',
            'email' => 'example@example.com',
            'password' => bcrypt('password'),
            'company_icon' => UploadedFile::fake()->image('test.jpg')
        ];

        $this->get('company/login')
            ->assertOk();

        $company = Company::factory()->create($dbData);

        $this->post('company/login', $postData)
            ->assertRedirect('/company');

        $this->assertAuthenticatedAs($company, 'company');
    }

    /**
     * @test
     * App\Http\Controllers\Auth\LoginController @CompanyLogin
     */
    public function 企業ログインバリデーション検証()
    {
        $url = 'company/login';

        $this->from($url)->post($url, [])
            ->assertRedirect($url);

        $this->post($url, ['email' => ''])->assertSessionHasErrors(['email' => 'メールアドレスは必須です。']);

        $this->post($url, ['password' => ''])->assertSessionHasErrors(['password' => 'パスワードは必須です。']);
    }

    /**
     * @test
     * App\Http\Controllers\Auth\LoginController @CompanyLogin
     */
    public function 企業ログインエラー()
    {
        $url = 'company/login';

        $postData = [
            'email' => 'test@example.com',
            'password' => 'password'
        ];

        $dbData = [
            'name' => 'user',
            'email' => 'example@example.com',
            'password' => bcrypt('password'),
            'company_icon' => UploadedFile::fake()->image('test.jpg')
        ];

        Company::factory()->create($dbData);

        $this->from($url)->post($url, $postData)
            ->assertRedirect($url);
    }

    /**
     * @test
     * App\Http\Controllers\Auth\LoginController @logout
     */
    public function 企業ログアウトできる()
    {
        $this->loginAsCompany();

        $this->delete('company/logout')
            ->assertRedirect('/company/login');
    }

}
