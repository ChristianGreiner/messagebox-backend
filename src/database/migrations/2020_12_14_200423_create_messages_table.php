<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            $table->text('text')->nullable();
            $table->string('gif_url')->nullable();

            $table->string('text_color', 6)->default('ffffff');
            $table->string('background_color', 6)->default('000000');

            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('addressee_id');

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('addressee_id')->references('id')->on('users')->onDelete('cascade');
       
            $table->boolean('read')->default(false);
            
            $table->string('type')->default('text');

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
        Schema::dropIfExists('messages');
    }
}
