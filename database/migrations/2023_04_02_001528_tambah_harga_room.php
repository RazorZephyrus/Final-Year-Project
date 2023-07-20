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
        //
        Schema::table('room', function (Blueprint $table) {
            $table->bigInteger('harga')->nullable();
            $table->string('type_harga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('room', function (Blueprint $table) {
            $table->dropColumn('harga');
            $table->dropColumn('type_harga');
        });
    }
};
