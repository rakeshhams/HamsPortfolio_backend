<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCommonInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_common_info', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->nullable(); // Hero image
            $table->string('title')->nullable(); // Title
            $table->text('description')->nullable(); // Description
            $table->string('meta_title')->nullable(); // Meta title
            $table->text('meta_description')->nullable(); // Meta description
            $table->integer('product')->nullable(); // Number of products
            $table->integer('export')->nullable(); // Number of exports
            $table->integer('destination')->nullable(); // Number of destinations
            $table->integer('human_impact')->nullable(); // Number of human impact
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
        Schema::dropIfExists('product_common_info');
    }
}
