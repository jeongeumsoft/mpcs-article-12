<?php

namespace Exit11\Article;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class ArticleServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $commands = [
        // Console\InstallCommand::class,
        Commands\SeedCommand::class,
    ];


    public function boot()
    {

        // 뷰템플릿 로드
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mpcs-article');

        /* 콘솔에서 vendor:publish 가동시 설치 파일 */
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            $this->publishes([__DIR__ . '/../config' => config_path()], 'config');
        }

        /* 라우터, 다국어 */
        $this->app->booted(function () {

            // 다국어 알리어스를 mpcs로 네이밍 규칙을 통일하여 사용하기로 함
            $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'mpcs-article');
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
        $this->registerEloquentFactoriesFrom(__DIR__ . '/../database/factories');
        $this->app->bind('Exit11\Article\Repositories\ArticleCategoryRepositoryInterface', 'Exit11\Article\Repositories\ArticleCategoryRepository');
        $this->app->bind('Exit11\Article\Repositories\ArticleRepositoryInterface', 'Exit11\Article\Repositories\ArticleRepository');
        $this->app->bind('Exit11\Article\Repositories\ArticleFileRepositoryInterface', 'Exit11\Article\Repositories\ArticleFileRepository');
        $this->app->bind('Exit11\Article\Repositories\PopupRepositoryInterface', 'Exit11\Article\Repositories\PopupRepository');
    }

    /**
     * Register factories.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }
}
