<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 15)->nullable()->unique();
            $table->string('password');
            $table->string('status')->nullable()->default('activé');
            $table->string('roles_name')->nullable()->default('["client"]');
            $table->string('nom_fichier', 50)->nullable()->default('default.png');
            $table->string('chemin', 100)->nullable()->default('assets/dist/storage/users/default.png');
            $table->unsignedBigInteger('IDClient')->nullable();
            $table->foreign('IDClient')->references('id')->on('clients')->onDelete('cascade');
            $table->dateTime('last_login_at')->nullable();
            $table->string('last_login_ip_address')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
