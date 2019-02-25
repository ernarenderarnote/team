<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->integer('job_type_id');
            $table->integer('category_id');
            $table->integer('grade_id');
            $table->string('title');
            $table->date('deadline')->nullable();
            $table->string('pay_type');
            $table->integer('pay_min');
            $table->integer('pay_max');
            $table->text('description');
            $table->text('education');
            $table->text('skills')->nullable();
            $table->text('additional_information')->nullable();
            $table->tinyInteger('is_close')->default(0);
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
        Schema::drop('jobs');
    }
}
