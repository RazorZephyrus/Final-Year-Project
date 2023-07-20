<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileInfosTable extends Migration {

	public function up()
	{
		Schema::create('file_infos', function(Blueprint $table) {
			$table->increments('id');
			$table->uuid('uuid')->unique();
			$table->morphs('fileable');
			$table->string('url');
			$table->string('name')->nullable();
			$table->string('disk', 64)->nullable();
			$table->string('mime_type')->nullable();
			$table->string('path')->nullable();
			$table->integer('size')->nullable();
			$table->string('slug', 64)->nullable();
			$table->json('data')->nullable();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('file_infos');
	}
}