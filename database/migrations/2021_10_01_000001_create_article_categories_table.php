<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('parent_id')->nullable()->index();
            $table->integer('order')->default(0);
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->tinyInteger('type')->unsigned()->default(1);
            $table->tinyInteger('page_style')->unsigned()->default(1);
            $table->tinyInteger('per_page')->unsigned()->default(15);
            $table->boolean('is_visible')->default(0);
            $table->unsignedTinyInteger('depth')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_categories');
    }
}
