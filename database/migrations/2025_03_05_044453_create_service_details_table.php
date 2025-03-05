<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->constrained('service_categories')->onDelete('cascade');
            $table->string('main_title');
            $table->text('main_description')->nullable();
            $table->string('subtitle_one')->nullable();
            $table->text('subdescription_one')->nullable();
            $table->string('subtitle_two')->nullable();
            $table->text('subdescription_two')->nullable();
            $table->string('subtitle_three')->nullable();
            $table->text('subdescription_three')->nullable();
            $table->string('subtitle_four')->nullable();
            $table->text('subdescription_four')->nullable();
            $table->string('subtitle_five')->nullable();
            $table->text('subdescription_five')->nullable();
            $table->string('subtitle_six')->nullable();
            $table->text('subdescription_six')->nullable();
            $table->string('subtitle_seven')->nullable();
            $table->text('subdescription_seven')->nullable();
            $table->text('description')->nullable();
            $table->string('name')->nullable();
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_details');
    }
}
