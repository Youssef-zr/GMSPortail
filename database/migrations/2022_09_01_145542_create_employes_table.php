<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 10)->unique();
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('cin', 50);
            $table->string('cnss', 50)->nullable();
            $table->unsignedBigInteger('IDSite')->nullable();
            $table->foreign('IDSite')->references('id')->on('sites')->onDelete('set null');
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
        Schema::dropIfExists('employes');
    }
}
