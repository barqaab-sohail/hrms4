<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrDocumentNamePrDocumentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_document_name_pr_documentation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->bigInteger('pr_documentation_id')->unsigned();
            $table->foreign('pr_documentation_id')->references('id')->on('pr_documentations')->onDelete('cascade');
            $table->bigInteger('pr_detail_id')->unsigned();

            $table->bigInteger('pr_document_name_id')->unsigned();
            $table->foreign('pr_document_name_id')->references('id')->on('pr_document_names');
            $table->foreign('pr_detail_id')->references('id')->on('pr_details')->onDelete('cascade');
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
        Schema::dropIfExists('pr_document_name_pr_documentation');
    }
}