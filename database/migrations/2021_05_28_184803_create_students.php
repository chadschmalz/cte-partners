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
