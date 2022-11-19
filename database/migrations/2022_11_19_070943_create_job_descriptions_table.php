<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 64)->nullable();
            $table->string('description', 1024)->nullable();
            $table->string('company_name', 64)->nullable();
            $table->string('company_detail', 64)->nullable();
            $table->string('company_url', 512)->nullable();
            $table->string('employment_type', 64)->nullable();
            $table->string('industry_type', 64)->nullable();
            $table->string('experince', 64)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_descriptions');
    }
};
