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
        Schema::table('asrama', function (Blueprint $table) {
            $table->string('no_rekening')->nullable();
            $table->string('no_kontak')->nullable();
            $table->text('asrama_role')->nullable();
            $table->text('informasi_lainnya')->nullable();
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
        Schema::table('asrama', function (Blueprint $table) {
            $table->dropColumn('no_rekening');
            $table->dropColumn('asrama_role');
            $table->dropColumn('no_kontak');
            $table->dropColumn('informasi_lainnya');
        });
    }
};
