<?php

namespace Mpcs\Article\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Mpcs\Article\Models\Article;

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
        factory(Article::class, 1000)
            ->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
