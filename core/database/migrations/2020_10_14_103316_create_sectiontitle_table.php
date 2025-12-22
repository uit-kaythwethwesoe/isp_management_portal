<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectiontitles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('language_id')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_subtitle')->nullable();
            $table->string('about_image')->nullable();
            $table->string('plan_title')->nullable();
            $table->string('plan_subtitle')->nullable();
            $table->string('offer_title')->nullable();
            $table->string('offer_subtitle')->nullable();
            $table->string('offer_image')->nullable();
            $table->string('service_title')->nullable();
            $table->string('service_subtitle')->nullable();
            $table->string('entertainment_title')->nullable();
            $table->string('entertainment_subtitle')->nullable();
            $table->string('media_zone_title')->nullable();
            $table->string('media_zone_subtitle')->nullable();
            $table->string('contact_title')->nullable();
            $table->string('contact_subtitle')->nullable();
            $table->string('media_title')->nullable();
            $table->string('branch_title')->nullable();
            $table->string('team_title')->nullable();
            $table->string('gallery_title')->nullable();
            $table->string('shop_title')->nullable();
            $table->string('blog_title')->nullable();
            $table->string('blog_subtitle')->nullable();
            $table->string('testimonial_title')->nullable();
            $table->string('testimonial_subtitle')->nullable();
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
        Schema::dropIfExists('section_title');
    }
}
