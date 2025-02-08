<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Service name
            $table->string('title')->nullable(); // Service title
            $table->string('subtitle')->nullable(); // Service subtitle
            $table->string('image')->nullable(); // Service image
            $table->text('description')->nullable(); // Service description
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
        Schema::dropIfExists('home_services');
    }
}
