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
            $table->unsignedBigInteger('guards_id');
            $table->string('route')->unique()->nullable();
            $table->string('svg')->unique()->nullable();
            $table->integer('sort');
            $table->unsignedBigInteger('permissions_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            //FOREIGN KEYS
            $table->foreign('guards_id','menus_fk0')->on('guards')->references('id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('parent_id','menus_fk1')->on('menus')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign('menus_fk0');
            $table->dropForeign('menus_fk1');
        });
        Schema::dropIfExists('menus');
    }
};
