<?php

namespace Mpcs\Article\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Mpcs\Article\Models\Article;
use Mpcs\Article\Models\ArticleCategory;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Article::truncate();
        DB::table('article_categorizables')->truncate();
        factory(Article::class, 1000)
            ->create()
            ->each(function ($article) {
                if (ArticleCategory::all()->count() > 0) {
                    $article->articleCategories()->save(ArticleCategory::inRandomOrder()->first());
                }
            });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
