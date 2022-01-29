<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('sub_title');
            $table->string('slug');
            $table->integer('time');
            $table->string('time_unit');
            $table->integer('total');
            $table->string('total_unit');
            $table->string('image');
            $table->enum('level', [1,2,3,4,5])->comment("1: Gampang; 2: Gampang; 3: Menengah; 4: Rumit; 5: Sangat Rumit");
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
        Schema::dropIfExists('posts');
    }
}
