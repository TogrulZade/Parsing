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
        Schema::create('derman', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("kod");
            $table->text("name");
            $table->text("name2");
            $table->string("country");
            $table->string("company");
            $table->decimal("price", 6, 2);
            $table->string("link");
            $table->string("site");
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
        Schema::dropIfExists('derman');
    }
};
