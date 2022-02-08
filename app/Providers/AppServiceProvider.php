<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\DataProvider\RepositoryInterface\UserRepositoryInterface::class,
//            MySQLを使用
            \App\DataProvider\UserRepository::class
//            SQliteを使用
//            \App\DataProvider\Sqlite\UserSqliteRepository::class
        );
        $this->app->bind(
            \App\DataProvider\RepositoryInterface\ChatRepositoryInterface::class,
            \App\DataProvider\ChatRepository::class
        );
        $this->app->bind(
            \App\DataProvider\RepositoryInterface\CompanyRepositoryInterface::class,
            \App\DataProvider\CompanyRepository::class
        );
        $this->app->bind(
            \App\DataProvider\RepositoryInterface\DiagnosisRepositoryInterface::class,
            \App\DataProvider\DiagnosisRepository::class
        );
        $this->app->bind(
            \App\DataProvider\Storage\S3\S3Interface\S3Interface::class,
            \App\DataProvider\Storage\S3\S3Storage::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        Paginator::useBootstrap();
        if (!app()->isLocal()) {
            $url->forceScheme('https');
        }
    }
}
