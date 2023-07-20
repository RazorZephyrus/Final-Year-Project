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
        Schema::table('booking', function (Blueprint $table) {
            $table->integer('length_of_stay')->nullable();
            $table->bigInteger('total_price')->nullable();
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
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn('length_of_stay');
            $table->dropColumn('total_price');
        });
    }
};
