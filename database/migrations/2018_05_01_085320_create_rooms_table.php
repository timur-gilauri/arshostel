<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	class CreateRoomsTable extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('rooms', function (Blueprint $table) {
				$table->increments('id');
				$table->string('title');
				$table->string('type')->default('room');
				$table->integer('price')->nullable();
				$table->integer('beds')->nullable();
				$table->string('description')->nullable();
				$table->unsignedTinyInteger('available')->default(1);
				$table->integer('beds_available')->nullable();
				
				$table->string('image_file_name')->nullable();
				$table->integer('image_file_size')->nullable();
				$table->string('image_content_type')->nullable();
				$table->timestamp('image_updated_at')->nullable();
				
				
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
			Schema::dropIfExists('rooms');
		}
	}
