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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('pin_id');
			$table->string('comment');
            $table->timestamps();
			
			$table->foreign('user_id')
                    ->references('id')->on('users')
					->onDelete('CASCADE')->onUpdate('NO ACTION');
			
			$table->foreign('pin_id')
                    ->references('id')->on('pins')
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
        Schema::dropIfExists('comments');
    }
};
