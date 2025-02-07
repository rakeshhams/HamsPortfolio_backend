<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryCategoryImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_category_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('story_category_id'); // Foreign key for categories
            $table->string('image'); // Image path
            $table->timestamps(); // created_at and updated_at

            $table->foreign('story_category_id')->references('id')->on('story_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story_category_image');
    }
}
