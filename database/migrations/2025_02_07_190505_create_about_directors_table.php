<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutDirectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_directors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Director's name
            $table->string('designation'); // Director's designation
            $table->string('image')->nullable(); // Director's image
            $table->string('facebook_link')->nullable(); // Facebook link
            $table->string('linkedin_link')->nullable(); // LinkedIn link
            $table->string('twitter_link')->nullable(); // Twitter link
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
        Schema::dropIfExists('about_directors');
    }
}
