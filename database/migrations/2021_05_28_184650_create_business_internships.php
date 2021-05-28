<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInternships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_internships', function (Blueprint $table) {
            $table->id();
            $table->string('position_title')->nullable();
            $table->integer('business_id');
            $table->string('tier')->nullable();
            $table->string('entry_point')->nullable();
            $table->string('intern_length')->nullable();
            $table->string('contact_method')->nullable();
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
        Schema::dropIfExists('business_internships');
    }
}
