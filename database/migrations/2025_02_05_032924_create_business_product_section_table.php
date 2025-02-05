<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('business_product_section', function (Blueprint $table) {
            $table->id();
            $table->string('main_title'); // Section title
            $table->text('description')->nullable(); // Section description
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('business_product_section');
    }
};
