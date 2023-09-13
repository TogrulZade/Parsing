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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("domen");
            $table->string("link")->nullable();
            $table->integer("depo")->default(0);
            $table->integer("items_per_page")->nullable();
            $table->string("iterable")->nullable();
            $table->string("title")->nullable();
            $table->string("title2")->nullable();
            $table->string("price")->nullable();
            $table->string("company")->nullable();
            $table->string("country")->nullable();
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
        Schema::dropIfExists('sites');
    }
};
