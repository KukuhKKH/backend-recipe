<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToAllTable extends Migration
{
    private $tables = [
        "categories", "ingredient_details", "ingredients", "posts", "step_details", "steps", "tags", "users"
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $value) {
            Schema::table($value, function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $value) {
            Schema::table($value, function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
}
