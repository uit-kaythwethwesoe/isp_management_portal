<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraMoreTablesToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->tinyInteger('is_testimonial_bg')->default(1);
            $table->tinyInteger('is_counter_bg')->default(1);
            $table->tinyInteger('is_package_bg')->default(1);
            $table->tinyInteger('is_contact_banner_bg')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['is_testimonial_bg', 'is_counter_bg', 'is_package_bg', 'is_contact_banner_bg']);
        });
    }
}
