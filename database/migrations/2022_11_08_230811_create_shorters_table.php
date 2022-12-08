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
        Schema::create('shorters', function (Blueprint $table) {
            $table->id();
            $table -> string("url_key");
            $table -> string("original_url");
            $table -> string("redirect_url");
            $table -> string("userMail");
            $table -> integer("visitas");
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
        Schema::dropIfExists('shorters');
    }
};
