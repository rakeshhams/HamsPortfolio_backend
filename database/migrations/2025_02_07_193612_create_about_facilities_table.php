<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_facilities', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Facility title
            $table->string('short_description')->nullable(); // Short description
            $table->text('description')->nullable(); // Detailed description
            $table->string('image_one')->nullable(); // First image
            $table->string('image_two')->nullable(); // Second image
            $table->string('link')->nullable(); // External link
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_facilities');
    }
}
