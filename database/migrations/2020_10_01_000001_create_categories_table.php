<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable()->index();
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->text('description')->nullable();
            $table->tinyInteger('type')->unsigned()->default(1);
            $table->boolean('is_visible')->default(0);
            $table->unsignedTinyInteger('depth')->default(1);
            $table->softDeletes();
        });

        Schema::table('categories', function ($table) {
            $table->unique(['parent_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
