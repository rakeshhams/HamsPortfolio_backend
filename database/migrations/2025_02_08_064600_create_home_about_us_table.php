<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_about_us', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Section name
            $table->string('title')->nullable(); // Title
            $table->string('subtitle')->nullable(); // Subtitle
            $table->string('meta_title')->nullable(); // Meta title
            $table->text('meta_description')->nullable(); // Meta description
            $table->text('description')->nullable(); // Detailed description
            $table->string('youtube_link')->nullable(); // YouTube link
            $table->string('link')->nullable(); // External link
            $table->string('image')->nullable(); // Section image
            $table->integer('experience_count')->nullable(); // Experience count
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
        Schema::dropIfExists('home_about_us');
    }
}
