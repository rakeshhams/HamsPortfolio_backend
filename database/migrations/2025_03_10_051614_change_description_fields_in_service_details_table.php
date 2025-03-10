<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeDescriptionFieldsInServiceDetailsTable extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE service_details MODIFY main_description LONGTEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_one LONGTEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_two LONGTEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_three LONGTEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_four LONGTEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_five LONGTEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_six LONGTEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_seven LONGTEXT');
        DB::statement('ALTER TABLE service_details MODIFY description LONGTEXT');
    }

    public function down()
    {
        DB::statement('ALTER TABLE service_details MODIFY main_description TEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_one TEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_two TEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_three TEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_four TEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_five TEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_six TEXT');
        DB::statement('ALTER TABLE service_details MODIFY subdescription_seven TEXT');
        DB::statement('ALTER TABLE service_details MODIFY description TEXT');
    }
}
