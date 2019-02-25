<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer("credit")->default(0);
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->text('answers')->nullable();
            $table->text('school_id')->nullable();

            $table->string('region')->nullable();
            $table->string('relocate')->nullable();
            $table->string('gender')->nullable();
            $table->string('campus')->nullable();
            $table->string('classify')->nullable();
            $table->string('creditable_experience')->nullable();
            $table->string('amount_order_to_relocate')->nullable();
            $table->string('degree_attained')->nullable();
            $table->string('current_position')->nullable();
            $table->string('least_amount')->nullable();
            $table->text('accept_positions')->nullable();
            $table->string('experience')->nullable();
            $table->string('certifications')->nullable();
            $table->string('is_additional_duties')->nullable();
            $table->string('notifications')->nullable();
            $table->string('resume')->nullable();

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
         Schema::drop('user_details');
    }
}
