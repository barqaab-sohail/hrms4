<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_experiences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hr_employee_id')->unsigned();
            $table->string('employer',90);
            $table->date('from');
            $table->date('to');
            $table->string('position',70);
            $table->text('activities'); //65,535 character including spaces
            $table->bigInteger('country_id')->unsigned();
            $table->timestamps();
            $table->foreign('hr_employee_id')->references('id')->on('hr_employees')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_experiences');
    }
}
