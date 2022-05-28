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
        Schema::create('pins', function (Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->unsignedBigInteger('user_id');
			$table->text('image');
			$table->unsignedInteger('width');
			$table->unsignedInteger('height');
            $table->timestamps();
			
			$table->foreign('user_id')
                    ->references('id')->on('users')
					->onDelete('CASCADE')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pins');
    }
};
