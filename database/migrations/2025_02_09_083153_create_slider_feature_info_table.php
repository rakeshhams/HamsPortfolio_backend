<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderFeatureInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_feature_info', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'title')->nullable(); // Title of the slider
            $table->string('image')->nullable(); // Image for the slider
            $table->text('description')->nullable(); // Description of the feature
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
        Schema::dropIfExists('slider_feature_info');
    }
}
