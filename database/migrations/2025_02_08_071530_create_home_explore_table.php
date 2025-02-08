<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeExploreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_explore', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Section name
            $table->string('title')->nullable(); // Title
            $table->text('description')->nullable(); // Description
            $table->string('image')->nullable(); // Image
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
        Schema::dropIfExists('home_explore');
    }
}
