<?php

namespace Exit11\Article\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Exit11\Article\Models\Article;
use Exit11\Article\Models\ArticleCategory;

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
        factory(Article::class, 100)
            ->create()
            ->each(function ($article) {
                if (ArticleCategory::all()->count() > 0) {
                    $article->articleCategories()->save(ArticleCategory::inRandomOrder()->first());
                }
            });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
