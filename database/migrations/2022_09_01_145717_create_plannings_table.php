<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('color')->nullable()->default('bg-primary');
            $table->string('periodicity', 50)->nullable()->default('once');
            $table->integer('repeats')->nullable()->default(0);
            $table->integer('freq')->nullable();
            $table->string('freq_term')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('days')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('IDClient')->nullable();
            $table->foreign('IDClient')->references('id')->on('clients')->onDelete('set null');

            // $table->string('gToken');
            // $table->string('email');
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
        Schema::dropIfExists('plannings');
    }
}
