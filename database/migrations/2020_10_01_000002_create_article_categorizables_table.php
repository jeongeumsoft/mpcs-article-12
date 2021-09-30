<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategorizablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_categorizables', function (Blueprint $table) {
            $table->integer('article_category_id')->unsigned();
            $table->integer('article_categorizable_id')->unsigned();
            $table->string('article_categorizable_type', 50);

            // SQLSTATE[42000]: Syntax error or access violation: 1059 Identifier name 'article_categorizables_article_category_id_article_categorizable_id_index' is too long
            // 키명이 길어 두번째 인수에 별도 명칭 추가
            $table->index(['article_category_id', 'article_categorizable_id'], 'article_categorizables_category_id_categorizable_id_index');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_categorizables');
    }
}
