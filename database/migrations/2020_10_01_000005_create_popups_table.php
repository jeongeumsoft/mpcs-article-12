<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->unsigned()->default(1);
            $table->boolean('type')->default(0); // true : html , false: image
            $table->string('title');
            $table->LongText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('background_color', 50)->nullable();
            $table->string('url')->nullable();
            $table->boolean('target')->default(0);
            $table->dateTime('period_from');
            $table->dateTime('period_to');
            $table->boolean('is_visible')->default(0);
            $table->unsignedBigInteger('user_id')->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popups');
    }
}
