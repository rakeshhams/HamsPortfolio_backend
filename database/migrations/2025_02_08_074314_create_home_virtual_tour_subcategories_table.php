<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeVirtualTourSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_virtual_tour_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('home_virtual_tour_categories')->onDelete('cascade'); // Foreign key to categories
            $table->string('name'); // Subcategory name
            $table->string('background_image')->nullable(); // Background image for the subcategory
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
        Schema::dropIfExists('home_virtual_tour_subcategories');
    }
}
