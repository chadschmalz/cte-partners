<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('business_id')->nullable();
            $table->integer('pathway_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('emerg_contact')->nullable();
            $table->string('emerg_phone')->nullable();
            $table->string('emerg_email')->nullable();
            $table->string('transportation')->nullable();
            $table->string('school_name')->nullable();
            $table->string('semester_apply')->nullable();
            $table->string('accomodations')->nullable();
            $table->string('grad_year')->nullable();
            $table->string('lane')->nullable();
            $table->string('placement_status')->nullable();
            $table->string('onboarding')->nullable();
            $table->string('lettersent')->nullable();
            $table->datetime('lettersent_at')->nullable();

            $table->string('studentresponse')->nullable();
            $table->datetime('studentresponse_at')->nullable();

            $table->string('ta')->nullable();
            $table->datetime('ta_at')->nullable();

            $table->string('la')->nullable();
            $table->datetime('la_at')->nullable();

            $table->string('mock')->nullable();
            $table->datetime('mock_at')->nullable();

            $table->string('resume')->nullable();
            $table->datetime('resume_at')->nullable();

            $table->string('dropped')->nullable();
            $table->datetime('dropped_at')->nullable();

            $table->string('ws1')->nullable();
            $table->string('ws2')->nullable();

            $table->text('cte_courses')->nullable();
            $table->text('career_interest')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
