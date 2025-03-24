<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('business_product_images', function (Blueprint $table) {
            $table->string('pageLink')->nullable(); // Add pageLink as a nullable string
            $table->text('description')->nullable(); // Add description as a nullable text field
        });
    }

    public function down() {
        Schema::table('business_product_images', function (Blueprint $table) {
            $table->dropColumn(['pageLink', 'description']); // Drop the pageLink and description columns
        });
    }
};
