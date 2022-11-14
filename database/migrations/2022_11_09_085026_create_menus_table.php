<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('svg')->unique()->nullable();
            $table->unsignedBigInteger('menu_levels_id');
            $table->timestamps();

            //FOREIGN KEYS
            $table->foreign('menu_levels_id','menus_fk0')->on('menu_levels')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign('menus_fk0');
        });
        Schema::dropIfExists('menus');
    }
};
