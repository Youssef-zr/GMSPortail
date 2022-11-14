<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('raison_sociale', 100);
            $table->string('email', 70);
            $table->string('nom_fichier', 50)->nullable()->default('default.png');
            $table->string('chemin', 100)->nullable()->default('assets/dist/storage/clients/default.png');
            $table->string('phone', 12);
            $table->string('code_client_omag', 30)->nullable();
            $table->enum('sync', [0, 1])->nullable()->default(0);
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
        Schema::dropIfExists('clients');
    }
}
