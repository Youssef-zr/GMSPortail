<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ltickets', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('duree')->nullable()->default(0);
            $table->unsignedBigInteger('IDTicket')->nullable();
            $table->foreign('IDTicket')->references('id')->on('clients')->onDelete('set null');
            $table->unsignedBigInteger('IDUtilisateur')->nullable();
            $table->foreign('IDUtilisateur')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('IDClient')->nullable();
            $table->foreign('IDClient')->references('id')->on('clients')->onDelete('set null');

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
        Schema::dropIfExists('ltickets');
    }
}
