<?php

namespace Exit11\Article;

use Exit11\Article\Models;
use Exit11\Article\Policies;
use Mpcs\Core\Facades\Core;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ArticleAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Models\ArticleCategory::class => Policies\ArticleCategoryPolicy::class,
        Models\Article::class => Policies\ArticlePolicy::class,
        Models\ArticleFile::class => Policies\ArticleFilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // Auth
        Auth::shouldUse(Core::getConfig('auth_guard'));
        $this->registerPolicies();
    }
}
