<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('business_hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Hero title
            $table->text('description')->nullable(); // Hero description
            $table->string('hero_image')->nullable(); // Hero image
            $table->string('additional_image')->nullable(); // Additional image
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('business_hero_sections');
    }
};

