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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->string('nik')->unique()->nullable();
            $table->string('name')->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('phone', 64)->unique()->nullable();
            $table->string('pob')->nullable();
            $table->date('dob')->nullable();
            $table->string('avatar_url')->nullable();
            $table->integer('created_by')->unsigned()->nullable()->index();
            $table->integer('updated_by')->unsigned()->nullable()->index();
            $table->integer('deleted_by')->unsigned()->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
