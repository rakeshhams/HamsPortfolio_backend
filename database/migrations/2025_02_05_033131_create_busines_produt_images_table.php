<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('business_product_images', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Image title
            $table->string('image'); // Image path
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('business_product_images');
    }
};
