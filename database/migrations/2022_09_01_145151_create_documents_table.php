<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 200);
            $table->string('nom_fichier', 50)->nullable();
            $table->string('chemin', 100)->nullable();
            $table->unsignedBigInteger('IDType')->nullable();
            $table->foreign('IDType')->references('id')->on('type_documents')->onDelete('set null');
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
        Schema::dropIfExists('documents');
    }
}
