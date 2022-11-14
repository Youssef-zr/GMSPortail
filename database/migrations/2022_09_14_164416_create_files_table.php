<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('original_name');
            $table->string('file_name');
            $table->string('file_extension');
            $table->string('file_size');
            $table->string('file_path');
            $table->unsignedBigInteger('IDTicket')->nullable();
            $table->foreign('IDTicket')->references('id')->on('tickets')->onDelete('set null');
            $table->unsignedBigInteger('lTicket')->nullable();
            $table->foreign('lTicket')->references('id')->on('ltickets')->onDelete('set null');
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
        Schema::dropIfExists('files');
    }
}
