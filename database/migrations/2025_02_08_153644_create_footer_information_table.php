<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_information', function (Blueprint $table) {
            $table->id();
            $table->text('address')->nullable(); // Company address
            $table->text('factory_address')->nullable(); // Factory address
            $table->string('gmail')->nullable(); // Gmail
            $table->string('social_link_one')->nullable(); // Social media link one
            $table->string('social_link_two')->nullable(); // Social media link two
            $table->string('social_link_three')->nullable(); // Social media link three
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
        Schema::dropIfExists('footer_information');
    }
}
