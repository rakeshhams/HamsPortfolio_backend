<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('business_overviews', function (Blueprint $table) {
            $table->id();
            $table->string('section'); // Stores section name (e.g., 'hero', 'business_overview')
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('image')->nullable(); // ✅ Make sure this column exists
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('business_overviews');
    }
};
