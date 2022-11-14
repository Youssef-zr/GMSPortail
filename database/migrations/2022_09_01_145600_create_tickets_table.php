<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('objet_ticket', 100);
            $table->string('statut')->nullable()->default("creation");
            $table->unsignedBigInteger('IDService')->nullable();
            $table->foreign('IDService')->references('id')->on('services')->onDelete('set null');
            $table->unsignedBigInteger('IDPriorite')->nullable();
            $table->foreign('IDPriorite')->references('id')->on('priorites')->onDelete('set null');
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
        Schema::dropIfExists('tickets');
    }
}
