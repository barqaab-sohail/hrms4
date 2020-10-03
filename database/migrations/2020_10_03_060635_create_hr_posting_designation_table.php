<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrPostingDesignationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_posting_designations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->bigInteger('hr_posting_id')->unsigned();
            $table->bigInteger('hr_designation_id')->unsigned();
            $table->timestamps();
            $table->foreign('hr_posting_id')->references('id')->on('hr_postings')->onDelete('cascade');
            $table->foreign('hr_designation_id')->references('id')->on('hr_designations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_posting_designations');
    }
}
