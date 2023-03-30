<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSemesters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_semesters', function (Blueprint $table) {
            $table->id();
            $table->integer('semester_id', 20)->nullable();
            $table->integer('pathway_id', 20)->nullable();
            $table->integer('semester_desc', 20)->nullable();
            $table->integer('seats', 20)->nullable();
            $table->string('schedule', 100)->nullable();
            $table->text('notes', 100)->nullable();
            $table->date('semester_enddt')->nullable();
            $table->string('status', 15)->nullable();
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
        Schema::dropIfExists('semesters');
    }
}